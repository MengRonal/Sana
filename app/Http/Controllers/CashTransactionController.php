<?php

namespace App\Http\Controllers;

use App\Models\CashTransaction;
use Illuminate\Http\Request;

class CashTransactionController extends Controller
{
    public function index()
    {
        $transactions = CashTransaction::all();

        return view('admin.cash_transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('admin.cash_transactions.create');
    }

    public function store(Request $request)
    {
        CashTransaction::create($request->all());

        return redirect()->route('cash_transactions.index');
    }

    public function show(CashTransaction $cash_transaction)
    {
        return view('admin.cash_transactions.show', compact('cash_transaction'));
    }

    public function edit(CashTransaction $cash_transaction)
    {
        return view('admin.cash_transactions.edit', compact('cash_transaction'));
    }

    public function update(Request $request, CashTransaction $cash_transaction)
    {
        $cash_transaction->update($request->all());

        return redirect()->route('cash_transactions.index');
    }

    public function destroy(CashTransaction $cash_transaction)
    {
        $cash_transaction->delete();

        return redirect()->route('cash_transactions.index');
    }
}