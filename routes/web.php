<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthContoller;
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

// Nal

Route::get('/admin/user', [AuthContoller::class , "index"])->name('auth.list');
Route::get('/admin/user/create', [AuthContoller::class, 'create'])->name('auth.create');
Route::post('/admin/user/store', [AuthContoller::class, 'store'])->name('auth.store');
