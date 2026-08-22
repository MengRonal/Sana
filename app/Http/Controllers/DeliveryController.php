<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $deliveries = Delivery::with('order.customer')
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest('delivery_id')
            ->paginate(15);

        return view('admin.delivery', compact('deliveries'));
    }

    public function create()
    {
        $orders = Order::whereDoesntHave('delivery')->orderBy('order_id', 'desc')->get();

        return view('admin.delivery.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id|unique:delivery,order_id',
            'address' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
        ]);

        Delivery::create([
            ...$validated,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.delivery.index')->with('success', 'Delivery created.');
    }

    public function edit(Delivery $delivery)
    {
        return view('admin.delivery.edit', compact('delivery'));
    }

    public function update(Request $request, Delivery $delivery)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:pending,out_for_delivery,delivered,cancelled',
        ]);

        $delivery->update($validated);

        return redirect()->route('admin.delivery.index')->with('success', 'Delivery updated.');
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return back()->with('success', 'Delivery removed.');
    }
}