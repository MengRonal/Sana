<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order; 
use App\Models\CashTransaction;
use App\Models\AccountingCategory;

class CashTransactionController extends Controller
{
    public function index(Request $request)
    {
        $fromDate   = $request->input('from');
        $toDate     = $request->input('to');
        $categoryId = $request->input('category_id');

        // 1. Total Sales
        $salesQuery = Order::where('is_paid', 1);
        if ($fromDate) $salesQuery->whereDate('order_date', '>=', $fromDate);
        if ($toDate)   $salesQuery->whereDate('order_date', '<=', $toDate);
        $totalSales = $salesQuery->sum('final_price'); 

        // 2. Cost of Goods Sold (COGS) - ប្រើ product.cost គុណនឹង quantity
        $cogsQuery = Order::where('orders.is_paid', 1)
            ->join('order_items', 'orders.order_id', '=', 'order_items.order_id')
            ->leftJoin('product', 'order_items.product_id', '=', 'product.product_id');

        if ($fromDate) $cogsQuery->whereDate('orders.order_date', '>=', $fromDate);
        if ($toDate)   $cogsQuery->whereDate('orders.order_date', '<=', $toDate);

        $totalCogs = $cogsQuery->sum(DB::raw('COALESCE(product.cost, 0) * order_items.quantity')); 

        // 3. Gross Profit
        $grossProfit = $totalSales - $totalCogs;

        // 4. Expenses & Other Income
        $transQuery = CashTransaction::with(['category', 'user']);
        if ($fromDate)   $transQuery->whereDate('transaction_date', '>=', $fromDate);
        if ($toDate)     $transQuery->whereDate('transaction_date', '<=', $toDate);
        if ($categoryId) $transQuery->where('category_id', $categoryId);

        $transactions = (clone $transQuery)->orderBy('transaction_date', 'desc')->paginate(15);

        $totalExpense = (clone $transQuery)->whereHas('category', fn($q) => $q->where('id_type', 2))->sum('amount');
        $otherIncome  = (clone $transQuery)->whereHas('category', fn($q) => $q->where('id_type', 1))->sum('amount');

        // 5. Net Profit
        $netProfit = ($grossProfit + $otherIncome) - $totalExpense;

        $categories = AccountingCategory::all();

        return view('admin.expense_income', compact(
            'totalSales', 'totalCogs', 'grossProfit', 'otherIncome', 'totalExpense', 'netProfit', 'transactions', 'categories'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'      => 'required',
            'amount'           => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'note'             => 'nullable|string',
        ]);

        CashTransaction::create([
            'category_id'      => $request->category_id,
            'amount'           => $request->amount,
            'transaction_date' => $request->transaction_date,
            'note'             => $request->note,
            'user_id'          => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Transaction recorded successfully.');
    }

    public function update(Request $request, $id)
    {
        $transaction = CashTransaction::findOrFail($id);

        $request->validate([
            'category_id'      => 'required',
            'amount'           => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'note'             => 'nullable|string',
        ]);

        $transaction->update([
            'category_id'      => $request->category_id,
            'amount'           => $request->amount,
            'transaction_date' => $request->transaction_date,
            'note'             => $request->note,
        ]);

        return redirect()->back()->with('success', 'Transaction updated successfully.');
    }

    public function destroy($id)
    {
        CashTransaction::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Transaction deleted successfully.');
    }
}