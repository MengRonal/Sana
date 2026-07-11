<?php

namespace App\Http\Controllers;

use App\Models\StockLog;
use Illuminate\Http\Request;

class StockLogController extends Controller
{
    public function index()
    {
        $stock_logs = StockLog::all();

        return view('admin.stock_logs.index', compact('stock_logs'));
    }

    public function create()
    {
        return view('admin.stock_logs.create');
    }

    public function store(Request $request)
    {
        StockLog::create($request->all());

        return redirect()->route('stock_logs.index');
    }

    public function show(StockLog $stock_log)
    {
        return view('admin.stock_logs.show', compact('stock_log'));
    }

    public function edit(StockLog $stock_log)
    {
        return view('admin.stock_logs.edit', compact('stock_log'));
    }

    public function update(Request $request, StockLog $stock_log)
    {
        $stock_log->update($request->all());

        return redirect()->route('stock_logs.index');
    }

    public function destroy(StockLog $stock_log)
    {
        $stock_log->delete();

        return redirect()->route('stock_logs.index');
    }
}