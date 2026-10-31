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
    // ==========================================
    // 1. បង្ហាញបញ្ជី Stock Logs (Inventory)
    // ==========================================
    public function index(Request $request)
    {
        $products = Product::orderBy('product_id', 'desc')->get();

        $logs = StockLog::with(['product', 'user'])
            ->when($request->product_id, fn ($q) => $q->where('product_id', $request->product_id))
            ->when($request->type, fn ($q) => $q->where('type', $request->type))
            ->latest('log_id')
            ->paginate(20);

        return view('admin.inventory', compact('logs', 'products'));
    }

    // ==========================================
    // 2. បង្ហាញ Form បង្កើត Stock Log ថ្មី
    // ==========================================
    public function create()
    {
        $products = Product::orderBy('product_id', 'desc')->get();

        return view('admin.inventory.create', compact('products'));
    }

    // ==========================================
    // 3. រក្សាទុក Stock Log ថ្មី និង កែសម្រួលចំនួន Qty
    // ==========================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:product,product_id', // ត្រូវជា product មិនមែន products ទេ។
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

            // 2. កែប្រែចំនួនក្នុង Table Product (ប្រើ qty និង product_id ឱ្យត្រូវនឹង Model)
            if ($validated['type'] === 'in') {
                Product::where('product_id', $validated['product_id'])->increment('qty', $validated['quantity']);
            } else {
                Product::where('product_id', $validated['product_id'])->decrement('qty', $validated['quantity']);
            }
        });

        return redirect()->route('admin.inventory.index')->with('success', 'Stock adjustment logged successfully.');
    }

    // ==========================================
    // 4. បង្ហាញ Form កែប្រែ Stock Log
    // ==========================================
    public function edit(StockLog $log)
    {
        $products = Product::orderBy('product_id', 'desc')->get();

        return view('admin.inventory.edit', compact('log', 'products'));
    }

    // ==========================================
    // 5. ធ្វើបច្ចុប្បន្នភាព Stock Log និង គណនាស្តុកឡើងវិញ
    // ==========================================
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
            // 1. Revert ចំនួនចាស់ចេញសិន
            if ($log->type === 'in') {
                Product::where('product_id', $log->product_id)->decrement('qty', $log->quantity);
            } else {
                Product::where('product_id', $log->product_id)->increment('qty', $log->quantity);
            }

            // 2. កាត់/បន្ថែម ចំនួនថ្មី
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

    // ==========================================
    // 6. លុប Stock Log និង Revert ចំនួនដើមវិញ
    // ==========================================
    public function destroy(StockLog $log)
    {
        DB::transaction(function () use ($log) {
            // Revert ចំនួនដើមវិញមុនពេលលុប Log
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