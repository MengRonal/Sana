<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. ទាញយកចំនួន Orders និងទឹកប្រាក់សរុបពី Table orders
        $totalOrders = DB::table('orders')->count();
        $totalSales = DB::table('orders')->sum('final_price'); 

        // 2. គណនាប្រាក់ចំណេញពីការលក់ (Gross Profit = Total Sales - Total Cost)
        $totalCost = DB::table('order_items')
            ->join('product', 'order_items.product_id', '=', 'product.product_id')
            ->sum(DB::raw('order_items.quantity * product.cost'));

        $totalGrossProfit = $totalSales - $totalCost;

        // 3. ទឹកប្រាក់ចំណាយសរុบ (Expenses) - Join ជាមួយ accounting_category (id_type = 2 គឺជា Expenses)
        $totalExpense = DB::table('cash_transactions')
            ->join('accounting_category', 'cash_transactions.category_id', '=', 'accounting_category.id')
            ->where('accounting_category.id_type', 2) // 2 គឺ Expenses
            ->sum('cash_transactions.amount');

        // 4. ទឹកប្រាក់ចំណូលផ្សេងៗសរុប (Other Income) - Join ជាមួយ accounting_category (id_type = 1 គឺជា Income)
        $totalOtherIncome = DB::table('cash_transactions')
            ->join('accounting_category', 'cash_transactions.category_id', '=', 'accounting_category.id')
            ->where('accounting_category.id_type', 1) // 1 គឺ Income
            ->sum('cash_transactions.amount');

        // 5. គណនាប្រាក់ចំណេញសុទ្ធ
        $netProfit = ($totalGrossProfit + $totalOtherIncome) - $totalExpense;

        return view('admin.Admin_dashboard', compact(
            'totalOrders',
            'totalSales',
            'totalGrossProfit',
            'totalExpense',
            'totalOtherIncome',
            'netProfit'
        ));
    }
}