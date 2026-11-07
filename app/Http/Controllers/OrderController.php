<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Costumer;
use App\Models\User;
use App\Models\OrderType;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // ============================================
    // 1. បង្ហាញបញ្ជីការកម្ម៉ង់ទាំងអស់ (Order List)
    // ============================================
    public function index(Request $request)
    {
        // បន្ថែម orderItems.product ដើម្បីបង្ហាញ sub items និង receipt
        $query = Order::with([
            'customer',
            'cashier',
            'orderType',
            'paymentMethod',
            'orderItems.product',
        ]);

        // Search តាម order_id, payment_status ឬ ឈ្មោះ customer
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'LIKE', "%{$search}%")
                  ->orWhere('payment_status', 'LIKE', "%{$search}%")
                  ->orWhereHas('customer', function ($c) use ($search) {
                      $c->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        // Filter តាម Paid / Unpaid
        if ($request->filled('status')) {
            $query->where('is_paid', $request->status === 'paid' ? 1 : 0);
        }

        // Filter តាមចន្លោះកាលបរិច្ឆេទ
        if ($request->filled('start_date')) {
            $query->whereDate('order_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('order_date', '<=', $request->end_date);
        }

        $orders = $query->orderByDesc('order_date')
                         ->withCount('orderItems')
                         ->paginate(5)
                         ->withQueryString();

        // Summary cards
        $summary = [
            'total'         => Order::count(),
            'pending'       => Order::where('is_paid', 0)->count(),
            'completed'     => Order::where('is_paid', 1)->count(),
            'revenue_today' => Order::whereDate('order_date', today())
                                     ->where('is_paid', 1)
                                     ->sum('final_price'),
        ];

        return view('admin.older', compact('orders', 'summary'));
    }

    // ============================================
    // 2. បង្ហាញ Form សម្រាប់បង្កើតការកម្ម៉ង់ថ្មី
    // ============================================
    public function create()
    {
        $customers      = Costumer::all();
        $cashiers       = User::all();
        $orderTypes     = OrderType::all();
        $paymentMethods = PaymentMethod::all();

        return view('admin.older.create', compact('customers', 'cashiers', 'orderTypes', 'paymentMethods'));
    }

    // ============================================
    // 3. រក្សាទុកទិន្នន័យការកម្ម៉ង់ថ្មីចូល Database
    // ============================================
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'        => 'required',
            'order_type_id'      => 'required',
            'payment_method_id'  => 'required',
            'total_amount'       => 'required|numeric|min:0',
            'discount'           => 'nullable|numeric|min:0|max:100',
        ]);

        $data = $request->all();
        $data['is_paid'] = $request->has('is_paid');

        // Final Price = Total - (Discount% × Total)
        $totalAmount = (float) $request->total_amount;
        $discount    = (float) ($request->discount ?? 0);

        $data['final_price'] = round($totalAmount - ($discount / 100 * $totalAmount), 2);

        Order::create($data);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // ============================================
    // 4. បង្ហាញ Form កែប្រែទិន្នន័យការកម្ម៉ង់
    // ============================================
    public function edit($id)
    {
        $order          = Order::findOrFail($id);
        $customers      = Costumer::all();
        $cashiers       = User::all();
        $orderTypes     = OrderType::all();
        $paymentMethods = PaymentMethod::all();

        return view('admin.older.edit', compact('order', 'customers', 'cashiers', 'orderTypes', 'paymentMethods'));
    }

    // ============================================
    // 5. ធ្វើបច្ចុប្បន្នភាពទិន្នន័យថ្មីទៅក្នុង Database
    // ============================================
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'customer_id'   => 'required',
            'order_type_id' => 'required',
            'total_amount'  => 'required|numeric|min:0',
            'discount'      => 'nullable|numeric|min:0|max:100',
        ]);

        $data = $request->all();
        $data['is_paid'] = $request->has('is_paid');

        $totalAmount = (float) $request->total_amount;
        $discount    = (float) ($request->discount ?? 0);

        $data['final_price'] = round($totalAmount - ($discount / 100 * $totalAmount), 2);

        $order->update($data);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // ============================================
    // 6. លុបការកម្ម៉ង់ចោល (Paid មិនអនុញ្ញាតឲ្យលុប)
    // ============================================
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        if ($order->is_paid) {
            return redirect()->route('orders.index')
                ->with('error', 'Paid orders cannot be deleted.');
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}