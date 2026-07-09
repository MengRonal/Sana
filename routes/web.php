<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('pos.dashboard');
});

Route::get('/pos/sale', function () {
    return view('pos.sale');
})->name('pos.sale');

Route::get('/admin', function () {
    return view('admin.Admin_dashboard');
})->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

// លុប Route Closure ចាស់ចេញ
// Route::get('/admin/product', function () {
//     return view('admin.product');
// })->name('admin.product');

// ប្រើ Controller ជំនួស
Route::get('/admin/product', [ProductController::class, 'index'])
    ->name('admin.product');

// Resource Routes
Route::resource('categories', CategoryController::class);
Route::resource('admin/products', ProductController::class)->names('products');