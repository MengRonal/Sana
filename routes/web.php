<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\SupplierController;
// Route web
Route::get('/web', function () {
    return view('website.main');
});

// Route Pos
Route::get('/pos', function () {
    return view('pos.dashboard');
});

Route::get('/pos/sale', function () {
    return view('pos.sale');
})->name('pos.sale');


Route::get('/', function () {
    return view('admin.login');
});

Route::get('/admin/product', function(){
    return view('admin.product');
})->name('admin.product');

// Route Admin
Route::get('/admin', function () {
    return view('admin.Admin_dashboard');
})->name('admin.dashboard');
Route::get('/admin/user', [AuthContoller::class , "index"])->name('auth.list');
Route::get('/admin/user/create', [AuthContoller::class, 'create'])->name('auth.create');
Route::post('/admin/user/store', [AuthContoller::class, 'store'])->name('auth.store');
Route::get('/admin/user/{user_id}',[AuthContoller::class, 'delete'])->name('auth.delete');
Route::get('/admin/user/edit/{user_id}',[AuthContoller::class, 'edit'])->name('auth.edit');
Route::post('/admin/user/update/{user_id}',[AuthContoller::class, 'update'])->name('auth.update');


Route::get('/admin/supplier', [SupplierController::class , "index"])->name('supplier.list');
Route::get('/admin/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('/admin/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('/admin/supplier/{supplier_id}',[SupplierController::class, 'delete'])->name('supplier.delete');
Route::get('/admin/supplier/edit/{supplier_id}',[SupplierController::class, 'edit'])->name('supplier.edit');
Route::post('/admin/supplier/update/{supplier_id}',[SupplierController::class, 'update'])->name('supplier.update');



Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');

Route::get('/admin/olders', [OrderController::class, 'index'])->name('admin.olders');
Route::get('/admin/older_items', [OrderItemController::class, 'index'])->name('admin.older_items');

// Resource Routes
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('order_items', OrderItemController::class);

