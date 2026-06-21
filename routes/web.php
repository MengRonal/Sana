<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;

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
