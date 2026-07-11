<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockLogController;
use App\Http\Controllers\CashTransactionController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('admin.Admin_dashboard');
});

Route::get('/admin', function () {
    return view('admin.Admin_dashboard');
});

/*
|--------------------------------------------------------------------------
| Product & Category
|--------------------------------------------------------------------------
*/

Route::get('/admin/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/admin/category', [CategoryController::class, 'index'])->name('category.index');

/*
|--------------------------------------------------------------------------
| Purchases
|--------------------------------------------------------------------------
*/

Route::resource('purchases', PurchaseController::class);

/*
|--------------------------------------------------------------------------
| Stock Logs
|--------------------------------------------------------------------------
*/

Route::resource('stock_logs', StockLogController::class);

/*
|--------------------------------------------------------------------------
| Cash Transactions
|--------------------------------------------------------------------------
*/

Route::resource('cash_transactions', CashTransactionController::class);

/*
|--------------------------------------------------------------------------
| Delivery
|--------------------------------------------------------------------------
*/

Route::resource('delivery', DeliveryController::class);

/*
|--------------------------------------------------------------------------
| Reviews
|--------------------------------------------------------------------------
*/

Route::resource('reviews', ReviewController::class);