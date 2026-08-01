<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\User;
use App\Models\OrderType;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 1. បង្ហាញបញ្ជីការកម្ម៉ង់ទាំងអស់
    public function index(Request $request)
    {
        $search = $request->get('search');

        if (!empty($search)) {
            // បានថែម withQueryString() ដើម្បីរក្សាពាក្យ Search ពេលចុចប្តូរទំព័រ
            $orders = Order::where('order_id', 'LIKE', "%{$search}%")
                ->orWhere('payment_status', 'LIKE', "%{$search}%")
                ->paginate(5)
                ->withQueryString();
        } else {
            $orders = Order::paginate(5);
        }

        return view('admin.older', compact('orders'));
    }

    // 2. បង្ហាញ Form សម្រាប់បង្កើតការកម្ម៉ង់ថ្មី
    public function create()
    {
        $customers      = Customer::all();
        $cashiers       = User::all();
        $orderTypes     = OrderType::all();
        $paymentMethods = PaymentMethod::all();

        return view('admin.older.create', compact('customers', 'cashiers', 'orderTypes', 'paymentMethods'));
    }

    // 3. រក្សាទុកទិន្នន័យការកម្ម៉ង់ថ្មីចូល Database
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'    => 'required',
            'order_type_id'  => 'required',
        ]);

        $data = $request->all();
        $data['is_paid'] = $request->has('is_paid');

        Order::create($data);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // 4. បង្ហាញ Form កែប្រែទិន្នន័យការកម្ម៉ង់
    public function edit($id)
    {
        $order          = Order::findOrFail($id);
        $customers      = Customer::all();
        $cashiers       = User::all();
        $orderTypes     = OrderType::all();
        $paymentMethods = PaymentMethod::all();

        return view('admin.older.edit', compact('order', 'customers', 'cashiers', 'orderTypes', 'paymentMethods'));
    }

    // 5. ធ្វើបច្ចុប្បន្នភាពទិន្នន័យថ្មីទៅក្នុង Database
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'customer_id'    => 'required',
            'order_type_id'  => 'required',
        ]);

        $data = $request->all();
        $data['is_paid'] = $request->has('is_paid');

        $order->update($data);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // 6. លុបការកម្ម៉ង់ចោល
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}