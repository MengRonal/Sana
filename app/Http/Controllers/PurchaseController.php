<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountingCategory;
use App\Models\CashTransaction;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\StockLog;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $purchases = Purchase::with(['supplier', 'product', 'user'])
        ->when($request->search, function ($q) use ($request) {
            $q->whereHas('product', function ($p) use ($request) {
                $p->where('product_name', 'like', "%{$request->search}%");
            });
        })
        ->latest('purchase_id')
        ->paginate(15);

    $suppliers = Supplier::all();
    $products = Product::all();

    return view('admin.purchase', compact(
        'purchases',
        'suppliers',
        'products'
    ));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('product_name')->get();

        return view('admin.purchase.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'supplier_id'   => 'required|exists:suppliers,supplier_id',
        'product_id'    => 'required|exists:product,product_id',
        'quantity'      => 'required|integer|min:1',
        'cost_price'    => 'required|numeric|min:0',
        'purchase_date' => 'required|date',
    ]);

    DB::transaction(function () use ($validated) {

        // 1. Create Purchase
        $purchase = Purchase::create([
            'supplier_id'   => $validated['supplier_id'],
            'product_id'    => $validated['product_id'],
            'quantity'      => $validated['quantity'],
            'cost_price'    => $validated['cost_price'],
            'purchase_date' => $validated['purchase_date'],
            'user_id'       => Auth::id(),
        ]);


        // 2. Update Product Stock
        Product::where('product_id', $validated['product_id'])
            ->increment('qty', $validated['quantity']);


        // 3. Create Stock Log
        StockLog::create([
            'product_id' => $validated['product_id'],
            'user_id'    => Auth::id(),
            'type'       => 'in',
            'quantity'   => $validated['quantity'],
            'reason'     => 'purchase',
            'note'       => "Restock from purchase #{$purchase->purchase_id}",
        ]);


        // 4. Find Expense Category
        $expenseCategory = AccountingCategory::whereHas(
            'type',
            fn ($q) => $q->where('id_type', 2)
        )->first();


        // 5. Create Cash Transaction
        if ($expenseCategory) {

            CashTransaction::create([
                'category_id'      => $expenseCategory->id,
                'amount'           => $validated['quantity'] * $validated['cost_price'],
                'transaction_date' => $validated['purchase_date'],
                'purchase_id'      => $purchase->purchase_id,
                'user_id'          => Auth::id(),
                'note'             => "Purchase #{$purchase->purchase_id}",
            ]);
        }
    });


    return redirect()
        ->route('purchase.index')
        ->with('success', 'Purchase recorded and stock updated.');
    }

    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('product_name')->get();

        return view('admin.purchase.edit', compact('purchase', 'suppliers', 'products'));
    }

    public function update(Request $request, Purchase $purchase)
    {
    $validated = $request->validate([
        'supplier_id'   => 'required',
        'product_id'    => 'required',
        'quantity'      => 'required|integer|min:1',
        'cost_price'    => 'required|numeric|min:0',
        'purchase_date' => 'required|date',
    ]);

    $purchase->update($validated);

    return redirect()
        ->route('purchase.index')
        ->with('success', 'Purchase updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {

        $purchase->delete();

        return back()->with('success', 'Purchase deleted.');
    }

}