<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

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

    // 2. បង្ហាញ Form បង្កើតថ្មី
    public function create()
    {
        $orders   = Order::all();
        $products = Product::where('status', 'Active')->get();

        return view('admin.older_item.create', compact('orders', 'products'));
    }

    // 3. រក្សាទុក
    public function store(Request $request)
    {
        $request->validate([
            'order_id'   => 'required',
            'product_id' => 'required',
            'quantity'   => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($request->product_id);

        // បើចំនួនលើសស្តុក → មិន Save ហើយលោត alert
        if ($request->quantity > $product->qty) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Insufficient stock! Only {$product->qty} of {$product->name} left.");
        }

        try {
            OrderItem::create($request->all());
        } catch (QueryException $e) {
            // backup layer ករណី DB Trigger fire
            return redirect()->back()
                ->withInput()
                ->with('error', 'Insufficient stock for this sale.');
        }

        return redirect()->route('order_items.index')
            ->with('success', 'Order item created successfully.');
    }

    // 4. បង្ហាញ Form កែប្រែ
    public function edit($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orders    = Order::all();
        $products  = Product::all();

        return view('admin.older_item.edit', compact('orderItem', 'orders', 'products'));
    }

    // 5. Update
    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::findOrFail($id);

        $request->validate([
            'order_id'   => 'required',
            'product_id' => 'required',
            'quantity'   => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
        ]);

        $product        = Product::findOrFail($request->product_id);
        $availableStock = $product->qty;

        // product ដដែល → បូក quantity ចាស់ត្រឡប់ជាស្តុកដែលអាចប្រើបាន
        if ($orderItem->product_id == $request->product_id) {
            $availableStock += $orderItem->quantity;
        }

        if ($request->quantity > $availableStock) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Insufficient stock! You can only sell up to {$availableStock} of {$product->name}.");
        }

        try {
            $orderItem->update($request->all());
        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Insufficient stock for this sale.');
        }

        return redirect()->route('order_items.index')
            ->with('success', 'Order item updated successfully.');
    }

    // 6. លុប
    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return redirect()->route('order_items.index')
            ->with('success', 'Order item deleted successfully.');
    }
}