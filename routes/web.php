<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OfferController;

// ==========================================
// 1. Route សម្រាប់ Website និង POS
// ==========================================
Route::get('/web', function () {
    return view('website.main');
});

Route::get('/pos', function () {
    return view('pos.dashboard');
});

Route::get('/pos/sale', function () {
    return view('pos.sale');
})->name('pos.sale');

Route::get('/', function () {
    return view('admin.login');
});

// ==========================================
// 2. Route សម្រាប់ប្រព័ន្ធគ្រប់គ្រង Admin
// ==========================================
Route::get('/admin', function () {
    return view('admin.Admin_dashboard');
})->name('admin.dashboard');

// ផ្នែកគ្រប់គ្រង User
Route::get('/admin/user', [AuthContoller::class, "index"])->name('auth.list');
Route::get('/admin/user/create', [AuthContoller::class, 'create'])->name('auth.create');
Route::post('/admin/user/store', [AuthContoller::class, 'store'])->name('auth.store');
Route::get('/admin/user/{user_id}', [AuthContoller::class, 'delete'])->name('auth.delete');
Route::get('/admin/user/edit/{user_id}', [AuthContoller::class, 'edit'])->name('auth.edit');
Route::post('/admin/user/update/{user_id}', [AuthContoller::class, 'update'])->name('auth.update');

// ផ្នែកគ្រប់គ្រងការកំណត់ (Setting)
Route::get('/admin/meanleap/setting', [SettingController::class, 'index'])->name('setting.list');
Route::get('/admin/meanleap/setting/create', [SettingController::class, 'create'])->name('setting.create');
Route::post('/admin/meanleap/setting/store', [SettingController::class, 'store'])->name('setting.store');
Route::get('/admin/meanleap/setting/edit/{id}', [SettingController::class, 'edit'])->name('setting.edit');
Route::post('/admin/meanleap/setting/update/{id}', [SettingController::class, 'update'])->name('setting.update');
Route::post('/admin/meanleap/setting/delete/{id}', [SettingController::class, 'delete'])->name('setting.delete');

// ផ្នែកគ្រប់គ្រងការផ្តល់ជូនពិសេស (Offer) - កែសម្រួលរួចរាល់លែងស្ទួន
Route::get('/admin/offer', [OfferController::class, 'index'])->name('offer.list');
Route::get('/admin/offer/add', [OfferController::class, 'create'])->name('offer.create');
Route::post('/admin/offer/store', [OfferController::class, 'store'])->name('offer.store');
Route::get('/admin/offer/{offer}/edit', [OfferController::class, 'edit'])->name('offer.edit');
Route::put('/admin/offer/{offer}', [OfferController::class, 'update'])->name('offer.update');
Route::delete('/admin/offer/{offer}', [OfferController::class, 'destroy'])->name('offer.destroy');

// ផ្នែកគ្រប់គ្រងអ្នកផ្គត់ផ្គង់ (Supplier)
Route::get('/admin/supplier', [SupplierController::class, "index"])->name('supplier.list');
Route::get('/admin/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('/admin/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('/admin/supplier/{supplier_id}', [SupplierController::class, 'delete'])->name('supplier.delete');
Route::get('/admin/supplier/edit/{supplier_id}', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::post('/admin/supplier/update/{supplier_id}', [SupplierController::class, 'update'])->name('supplier.update');

// ផ្នែកគ្រប់គ្រងផលិតផល (Product)
Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');

// ==========================================
// 3. Resource Routes (Categories & Products)
// ==========================================
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
