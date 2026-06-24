<?php

use Illuminate\Support\Facades\Route;

//use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/',function (){
    return view('pos.dashboard');
});
Route::get('/pos/sale', function(){
    return view('pos.sale');
})->name('pos.sale');


Route::get('/admin',function (){
    return view('admin.Admin_dashboard');
});

Route::get('/admin/product', function(){
    return view('admin.product');
})->name('admin.product');
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
