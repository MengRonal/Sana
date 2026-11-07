<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\OrderType;
use App\Models\Delivery;
use App\Models\Costumer;
use App\Models\User;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // ============================================
    // 1. បង្ហាញបញ្ជីការកម្ម៉ង់ទាំងអស់ (Order List)
    // ============================================
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'cashier', 'orderType', 'paymentMethod']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'LIKE', "%{$search}%")
                  ->orWhere('payment_status', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_paid', $request->status === 'paid' ? 1 : 0);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('order_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('order_date', '<=', $request->end_date);
        }

        $orders = $query->orderByDesc('order_id')
                        ->withCount('orderItems')
                        ->paginate(5)
                        ->withQueryString();

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
    // 3. រក្សាទុកទិន្នន័យការកម្ម៉ង់ថ្មីចូល Database និងកាត់ស្តុក
    // ============================================
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'        => 'required',
            'order_type_id'      => 'required',
            'payment_method_id'  => 'required',
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,product_id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.price'      => 'required|numeric|min:0',
            'discount'           => 'nullable|numeric|min:0|max:100',
        ]);

        DB::transaction(function () use ($request) {
            $totalAmount = 0;
            foreach ($request->items as $item) {
                $totalAmount += $item['quantity'] * $item['price'];
            }

            $discount = (float) ($request->discount ?? 0);
            $finalPrice = round($totalAmount - ($totalAmount * $discount / 100), 2);

            $order = Order::create([
                'customer_id'       => $request->customer_id,
                'cashier_id'        => auth()->id() ?? $request->cashier_id,
                'order_type_id'     => $request->order_type_id,
                'payment_method_id' => $request->payment_method_id,
                'waiting_num'       => $request->waiting_num ?? 1,
                'exchange_rate'     => $request->exchange_rate ?? 4100,
                'total_amount'      => $totalAmount,
                'discount'          => $discount,
                'final_price'       => $finalPrice,
                'payment_status'    => $request->payment_status ?? 'Paid',
                'is_paid'           => $request->has('is_paid') ? 1 : 0,
                'order_date'        => now(),
            ]);

            foreach ($request->items as $item) {
                $productId = $item['product_id'];
                $qty = $item['quantity'];
                $price = $item['price'];
                $subtotal = $qty * $price;

                OrderItem::create([
                    'order_id'   => $order->order_id,
                    'product_id' => $productId,
                    'quantity'   => $qty,
                    'price'      => $price,
                    'subtotal'   => $subtotal,
                ]);

                $product = Product::find($productId);
                if ($product) {
                    $product->decrement('stock', $qty);
                }

                Inventory::create([
                    'product_id' => $productId,
                    'type'       => 'Out',
                    'qty'        => -$qty,
                    'reason'     => 'Sale',
                    'note'       => 'លក់ចេញតាមរយៈ Order #' . $order->order_id,
                    'user_id'    => auth()->id() ?? 1,
                ]);
            }

            $orderType = OrderType::find($request->order_type_id);
            if ($request->filled('address') || ($orderType && stripos($orderType->order_name, 'delivery') !== false)) {
                Delivery::create([
                    'order_id' => $order->order_id,
                    'address'  => $request->address ?? 'N/A',
                    'cost'     => $request->delivery_cost ?? 0,
                    'status'   => 'pending',
                ]);
                $order->update(['status' => 'processing']);
            }
        });

        return redirect()->route('orders.index')->with('success', 'Order created and stock deducted successfully.');
    }

    // ============================================
    // 4. បង្ហាញ Form កែប្រែទិន្នន័យการកម្ម៉ង់
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
        $data['final_price'] = round($totalAmount - ($totalAmount * $discount / 100), 2);

        $order->update($data);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // ============================================
    // 6. លុបការកម្ម៉ង់ចោល
    // ============================================
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        DB::transaction(function () use ($order) {
            if ($order->delivery) {
                $order->delivery->delete();
            }
            $order->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}