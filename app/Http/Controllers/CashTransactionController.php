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
        $fromDate = $request->input('from');
        $toDate = $request->input('to');
        $categoryId = $request->input('category_id');

        // ==========================================
        // 1. គណនា Total Sales ពី POS (Table orders)
        // ==========================================
        $salesQuery = Order::query();
        
        // Filter តាមថ្ងៃខែ order_date
        if ($fromDate) $salesQuery->whereDate('order_date', '>=', $fromDate);
        if ($toDate) $salesQuery->whereDate('order_date', '<=', $toDate);

        // គណនាសរុបទឹកប្រាក់លក់បាន (final_price)
        $totalSales = $salesQuery->sum('final_price'); 


        // ==========================================
        // 2. គណនា Cost of Goods Sold (COGS / ដើមទុន)
        // ==========================================
        $cogsQuery = Order::query()
            ->join('order_items', 'orders.order_id', '=', 'order_items.order_id')
            ->leftJoin('product', 'order_items.product_id', '=', 'product.id');

        if ($fromDate) $cogsQuery->whereDate('orders.order_date', '>=', $fromDate);
        if ($toDate) $cogsQuery->whereDate('orders.order_date', '<=', $toDate);

        // 💡 កំណត់ 0 ជាបណ្តោះអាសន្ន ឬប្តូរ 'product.buy_price' តាមឈ្មោះ Column ដើមទុនជាក់ស្តែងក្នុង DB
        // $totalCogs = $cogsQuery->sum(DB::raw('COALESCE(product.buy_price, 0) * order_items.quantity'));
        $totalCogs = 0; 


        // ==========================================
        // 3. គណនា Gross Profit (ចំណេញដុល)
        // ==========================================
        $grossProfit = $totalSales - $totalCogs;


        // ==========================================
        // 4. ទាញទិន្នន័យ Expense & Other Income (cash_transactions)
        // ==========================================
        $transQuery = CashTransaction::with(['category', 'user']);

        if ($fromDate) $transQuery->whereDate('transaction_date', '>=', $fromDate);
        if ($toDate) $transQuery->whereDate('transaction_date', '<=', $toDate);
        if ($categoryId) $transQuery->where('category_id', $categoryId);

        // 💡 ប្រើ orderBy('transaction_date', 'desc') ជំនួស latest() ដើម្បីកុំឱ្យជួប Error លើ created_at
        $transactions = $transQuery->orderBy('transaction_date', 'desc')->paginate(15);

        // គណនាសរុប Other Income (id_type = 1)
        $otherIncome = (clone $transQuery)->whereHas('category', function($q) {
            $q->where('id_type', 1);
        })->sum('amount');

        // គណនាសរុប Expense (id_type = 2)
        $totalExpense = (clone $transQuery)->whereHas('category', function($q) {
            $q->where('id_type', 2);
        })->sum('amount');


        // ==========================================
        // 5. គណនា Net Profit / Loss (ចំណេញ/ខាតសុទ្ធ)
        // ==========================================
        $netProfit = $grossProfit + $otherIncome - $totalExpense;

        // ទាញ Categories ទាំងអស់មកបង្ហាញក្នុង Dropdown Filter/Modal
        $categories = AccountingCategory::all();

        return view('admin.expense_income', compact(
            'totalSales',
            'totalCogs',
            'grossProfit',
            'otherIncome',
            'totalExpense',
            'netProfit',
            'transactions',
            'categories'
        ));
    }
}