<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::all();

        return view('admin.delivery.index', compact('deliveries'));
    }

    public function create()
    {
        return view('admin.delivery.create');
    }

    public function store(Request $request)
    {
        Delivery::create($request->all());

        return redirect()->route('delivery.index');
    }

    public function show(Delivery $delivery)
    {
        return view('admin.delivery.show', compact('delivery'));
    }

    public function edit(Delivery $delivery)
    {
        return view('admin.delivery.edit', compact('delivery'));
    }

    public function update(Request $request, Delivery $delivery)
    {
        $delivery->update($request->all());

        return redirect()->route('delivery.index');
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return redirect()->route('delivery.index');
    }
}