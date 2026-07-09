<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthContoller;
Route::get('/', function () {
    return view('pos.dashboard');
});

Route::get('/pos/sale', function () {
    return view('pos.sale');
})->name('pos.sale');

Route::get('/admin', function () {
    return view('admin.Admin_dashboard');
})->name('admin.dashboard');

Route::get('/admin/product', function(){
    return view('admin.product');
})->name('admin.product');

// Nal

Route::get('/admin/user', [AuthContoller::class , "index"])->name('auth.list');
Route::get('/admin/user/create', [AuthContoller::class, 'create'])->name('auth.create');
Route::post('/admin/user/store', [AuthContoller::class, 'store'])->name('auth.store');
Route::get('/admin/user/{user_id}',[AuthContoller::class, 'delete'])->name('auth.delete');
Route::get('/admin/user/edit/{user_id}',[AuthContoller::class, 'edit'])->name('auth.edit');
Route::post('/admin/user/update/{user_id}',[AuthContoller::class, 'update'])->name('auth.update');


Route::get('/admin/product', [ProductController::class, 'index'])
    ->name('admin.product');

// Resource Routes
Route::resource('categories', CategoryController::class);
Route::resource('product', ProductController::class);
