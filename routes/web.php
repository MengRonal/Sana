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


Route::get('/admin/product', [ProductController::class, 'index'])
    ->name('admin.product');

// Resource Routes
Route::resource('categories', CategoryController::class);
Route::resource('product', ProductController::class);