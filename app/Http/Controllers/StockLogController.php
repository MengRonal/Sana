<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockLogController extends Controller
{
    public function index(Request $request)
    {
        // ទាញយក Product សម្រាប់បង្ហាញក្នុង Dropdown Filter
        $products = Product::orderBy('product_name')->get();

        // ទាញ Logs និង Filter តាម Product ឬ Type
        $logs = StockLog::with(['product', 'user'])
            ->when($request->product_id, fn ($q) => $q->where('product_id', $request->product_id))
            ->when($request->type, fn ($q) => $q->where('type', $request->type))
            ->latest('log_id') // ឬ latest() ប្រសិនបើ PK ជា id
            ->paginate(20);

        return view('admin.inventory', compact('logs', 'products'));
    }

    public function create()
    {
        $products = Product::orderBy('product_name')->get();

        return view('admin.inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:product,product_id',
            'type'       => 'required|in:in,out',
            'quantity'   => 'required|integer|min:1',
            'reason'     => 'required|string|max:255',
            'note'       => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            // 1. បង្កើត Stock Log
            StockLog::create([
                'product_id' => $validated['product_id'],
                'type'       => $validated['type'],
                'quantity'   => $validated['quantity'],
                'reason'     => $validated['reason'],
                'note'       => $validated['note'] ?? null,
                'user_id'    => Auth::id(),
            ]);

            // 2. កែប្រែចំនួនស្តុកក្នុង Table Product
            if ($validated['type'] === 'in') {
                Product::where('product_id', $validated['product_id'])->increment('qty', $validated['quantity']);
            } else {
                Product::where('product_id', $validated['product_id'])->decrement('qty', $validated['quantity']);
            }
        });

        // 💡 កែប្រែ Route Name ឱ្យដូចគ្នា
        return redirect()->route('admin.inventory.index')->with('success', 'Stock adjustment logged successfully.');
    }

    public function edit(StockLog $log)
    {
        $products = Product::orderBy('product_name')->get();

        return view('admin.inventory.edit', compact('log', 'products'));
    }

    public function update(Request $request, StockLog $log)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:product,product_id',
            'type'       => 'required|in:in,out',
            'quantity'   => 'required|integer|min:1',
            'reason'     => 'required|string|max:255',
            'note'       => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $log) {
            // 1. Revert ស្តុកចាស់ចេញសិន
            if ($log->type === 'in') {
                Product::where('product_id', $log->product_id)->decrement('qty', $log->quantity);
            } else {
                Product::where('product_id', $log->product_id)->increment('qty', $log->quantity);
            }

            // 2. កាត់/បន្ថែម ស្តុកថ្មីតាមព័ត៌មានដែលបាន Edit
            if ($validated['type'] === 'in') {
                Product::where('product_id', $validated['product_id'])->increment('qty', $validated['quantity']);
            } else {
                Product::where('product_id', $validated['product_id'])->decrement('qty', $validated['quantity']);
            }

            // 3. Update ទិន្នន័យ Log
            $log->update($validated);
        });

        return redirect()->route('admin.inventory.index')->with('success', 'Stock log updated and quantities re-synced.');
    }

    public function destroy(StockLog $log)
    {
        DB::transaction(function () use ($log) {
            // Revert ស្តុកដើមវិញមុនពេល លុប Log
            if ($log->type === 'in') {
                Product::where('product_id', $log->product_id)->decrement('qty', $log->quantity);
            } else {
                Product::where('product_id', $log->product_id)->increment('qty', $log->quantity);
            }

            $log->delete();
        });

        return back()->with('success', 'Stock log removed and quantity reverted.');
    }
}