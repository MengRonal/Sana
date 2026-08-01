<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // 1. បង្ហាញបញ្ជីទំនិញក្នុងការកម្ម៉ង់ទាំងអស់
    public function index(Request $request)
    {
        $search = $request->get('search');

        if (!empty($search)) {
            $orderItems = OrderItem::where('order_id', 'LIKE', "%{$search}%")
                ->orWhere('product_id', 'LIKE', "%{$search}%")
                ->paginate(5)
                ->withQueryString();
        } else {
            $orderItems = OrderItem::paginate(5);
        }

        return view('admin.older_item', compact('orderItems'));
    }

    // 2. បង្ហាញ Form សម្រាប់បង្កើតទំនិញក្នុងការកម្ម៉ង់ថ្មី
    public function create()
    {
        $orders   = Order::all();
        $products = Product::all();

        return view('admin.older_item', compact('orders', 'products'));
    }

    // 3. រក្សាទុកទិន្នន័យទំនិញក្នុងការកម្ម៉ង់ថ្មីចូល Database
    public function store(Request $request)
    {
        $request->validate([
            'order_id'   => 'required',
            'product_id' => 'required',
            'quantity'   => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
        ]);

        OrderItem::create($request->all());

        return redirect()->route('order_items.index')->with('success', 'Order item created successfully.');
    }

    // 4. បង្ហាញ Form កែប្រែទំនិញក្នុងការកម្ម៉ង់
    public function edit($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orders    = Order::all();
        $products  = Product::all();

        return view('admin.older_item.edit', compact('orderItem', 'orders', 'products'));
    }

    // 5. ធ្វើបច្ចុប្បន្នភាពទិន្នន័យថ្មីទៅក្នុង Database
    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::findOrFail($id);

        $request->validate([
            'order_id'   => 'required',
            'product_id' => 'required',
            'quantity'   => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
        ]);

        $orderItem->update($request->all());

        return redirect()->route('order_items.index')->with('success', 'Order item updated successfully.');
    }

    // 6. លុបទំនិញក្នុងការកម្ម៉ង់ចោល
    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return redirect()->route('order_items.index')->with('success', 'Order item deleted successfully.');
    }
}