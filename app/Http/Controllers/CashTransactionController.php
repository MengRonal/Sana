<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order; 
use App\Models\CashTransaction;
use App\Models\AccountingCategory;

class CashTransactionController extends Controller
{
    // 1. ទំព័របង្ហាញ Expenses (ចំណាយ) ដាច់ដោយឡែក
    public function expenses(Request $request)
    {
        $fromDate   = $request->input('from');
        $toDate     = $request->input('to');
        $categoryId = $request->input('category_id');

        $transQuery = CashTransaction::with(['category', 'user'])
            ->whereHas('category', fn($q) => $q->where('id_type', 2)); // id_type 2 = Expense

        if ($fromDate)   $transQuery->whereDate('transaction_date', '>=', $fromDate);
        if ($toDate)     $transQuery->whereDate('transaction_date', '<=', $toDate);
        if ($categoryId) $transQuery->where('category_id', $categoryId);

        $transactions = (clone $transQuery)->orderBy('transaction_date', 'desc')->paginate(15);
        $totalExpense = (clone $transQuery)->sum('amount');
        $categories   = AccountingCategory::where('id_type', 2)->get();

        return view('admin.expense', compact('transactions', 'categories', 'totalExpense'));
    }

    // 2. ទំព័របង្ហាញ Other Income (ចំណូលផ្សេងៗ) ដាច់ដោយឡែក
    public function incomes(Request $request)
    {
        $fromDate   = $request->input('from');
        $toDate     = $request->input('to');
        $categoryId = $request->input('category_id');

        $transQuery = CashTransaction::with(['category', 'user'])
            ->whereHas('category', fn($q) => $q->where('id_type', 1)); // id_type 1 = Income

        if ($fromDate)   $transQuery->whereDate('transaction_date', '>=', $fromDate);
        if ($toDate)     $transQuery->whereDate('transaction_date', '<=', $toDate);
        if ($categoryId) $transQuery->where('category_id', $categoryId);

        $transactions = (clone $transQuery)->orderBy('transaction_date', 'desc')->paginate(15);
        $otherIncome  = (clone $transQuery)->sum('amount');
        $categories   = AccountingCategory::where('id_type', 1)->get();

        return view('admin.income', compact('transactions', 'categories', 'otherIncome'));
    }

    // 3. រក្សាទុកទិន្នន័យ (Store)
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

    // 4. ធ្វើបច្ចុប្បន្នភាពទិន្នន័យ (Update)
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

    // 5. លុបទិន្នន័យ (Destroy)
    public function destroy($id)
    {
        CashTransaction::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Transaction deleted successfully.');
    }
}