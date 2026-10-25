<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    // ==========================================
    // 1. បង្ហាញបញ្ជី Delivery
    // ==========================================
    public function index(Request $request)
    {
        $deliveries = Delivery::with(['order.customer'])
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest('delivery_id')
            ->paginate(15);

        return view('admin.delivery', compact('deliveries'));
    }

    // ==========================================
    // 2. Form បង្កើត Delivery ថ្មី
    // ==========================================
    public function create()
    {
        // ទាញយកតែ Order ណាដែលមិនទាន់មាន Delivery និងមិនទាន់ Cancelled
        $orders = Order::whereDoesntHave('delivery')
            ->where('status', '!=', 'cancelled')
            ->orderBy('order_id', 'desc')
            ->get();

        return view('admin.delivery.create', compact('orders'));
    }

    // ==========================================
    // 3. រក្សាទុក Delivery ថ្មី
    // ==========================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id|unique:delivery,order_id',
            'address'  => 'required|string|max:255',
            'cost'     => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            Delivery::create([
                'order_id' => $validated['order_id'],
                'address'  => $validated['address'],
                'cost'     => $validated['cost'],
                'status'   => 'pending',
            ]);

            // 💡 ធ្វើបច្ចុប្បន្នភាព Status ក្នុង Order ទៅជា processing/delivering
            Order::where('order_id', $validated['order_id'])
                ->update(['status' => 'processing']);
        });

        return redirect()->route('admin.delivery.index')->with('success', 'Delivery created.');
    }

    // ==========================================
    // 4. Form កែប្រែ Delivery
    // ==========================================
    public function edit(Delivery $delivery)
    {
        return view('admin.delivery.edit', compact('delivery'));
    }

    // ==========================================
    // 5. Update Delivery និង Sync ទៅ Order Status
    // ==========================================
    public function update(Request $request, Delivery $delivery)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'cost'    => 'required|numeric|min:0',
            'status'  => 'required|in:pending,out_for_delivery,delivered,cancelled',
        ]);

        DB::transaction(function () use ($validated, $delivery) {
            
            // 1. Update ទិន្នន័យ Delivery
            $delivery->update($validated);

            // 💡 2. Sync Status ទៅ Table Order ស្វ័យប្រវត្តិ
            if ($validated['status'] === 'delivered') {
                Order::where('order_id', $delivery->order_id)->update(['status' => 'completed']);
            } elseif ($validated['status'] === 'cancelled') {
                Order::where('order_id', $delivery->order_id)->update(['status' => 'cancelled']);
            }
        });

        return redirect()->route('admin.delivery.index')->with('success', 'Delivery updated and Order status synced.');
    }

    // ==========================================
    // 6. លុប Delivery
    // ==========================================
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return back()->with('success', 'Delivery r  emoved.');
    }
}   