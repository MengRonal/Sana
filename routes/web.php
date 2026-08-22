<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\CostumerController;

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

// Route Admin
Route::get('/admin',[AuthContoller::class,'dash'])->name('admin.dashboard');
// admin login and register
Route::get('/',[AuthContoller::class, 'showLogin'])->name('showlogin');
Route::get('/register',[AuthContoller::class, 'showRegister'])->name('showRegister');
Route::post('/register/process',[AuthContoller::class, 'processRegister'])->name('process_Register');
Route::post('/login/process',[AuthContoller::class, 'processlogin'])->name('process_login');
Route::post('/logout', [AuthContoller::class, 'logout'])->name('process_logout');
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

Route::get('/admin/customer', [CostumerController::class , "index"])->name('customer.list');


Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');

Route::get('/admin/olders', [OrderController::class, 'index'])->name('admin.olders');
Route::get('/admin/older_items', [OrderItemController::class, 'index'])->name('admin.older_items');
// Resource Routes
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('order_items', OrderItemController::class);

//web login and register
Route::get('/web/shop', function () {
    return view('website.oder');
});

Route::get('/web/register',[CostumerController::class, 'webRegister'])->name('webRegister');
Route::get('/web/login',[CostumerController::class, 'webLogin'])->name('webLogin');
Route::post('/web/register/proces',[CostumerController::class, 'register'])->name('register');
Route::post('/web/login/proces',[CostumerController::class, 'login'])->name('login');
Route::post('/web/logout', [CostumerController::class, 'logout'])->name('logout');