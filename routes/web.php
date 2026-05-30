<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;

Route::get('/',function (){
    return view('pos.dashboard');
});
Route::get('/admin/dashboard',function (){
    return view('admin.Admin_dashboard');
});