<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public function index()
    {
        $purchases=Purchase::all();

        return view('admin.purchases.index',compact('purchases'));
    }

    public function create()
    {
        return view('admin.purchases.create');
    }

    public function store(Request $request)
    {

        Purchase::create($request->all());

        return redirect()->route('purchases.index');

    }

    public function show(Purchase $purchase)
    {
        return view('admin.purchases.show',compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        return view('admin.purchases.edit',compact('purchase'));
    }

    public function update(Request $request, Purchase $purchase)
    {

        $purchase->update($request->all());

        return redirect()->route('purchases.index');

    }

    public function destroy(Purchase $purchase)
    {

        $purchase->delete();

        return redirect()->route('purchases.index');

    }

}