<?php

use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\CashTransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StockLogController;
use App\Http\Controllers\CostumerController;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SupplierController;
<<<<<<< HEAD
use App\Http\Controllers\AccountingCategoryController;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
// Route web
=======
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OfferController;

// ==========================================
// 1. Route សម្រាប់ Website និង POS
// ==========================================
>>>>>>> origin/leap
Route::get('/web', function () {
    return view('website.main');
});

Route::get('/pos', function () {
    return view('pos.dashboard');
});

<<<<<<< HEAD
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
=======
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
>>>>>>> origin/leap
Route::get('/admin/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('/admin/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('/admin/supplier/{supplier_id}', [SupplierController::class, 'delete'])->name('supplier.delete');
Route::get('/admin/supplier/edit/{supplier_id}', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::post('/admin/supplier/update/{supplier_id}', [SupplierController::class, 'update'])->name('supplier.update');

// ផ្នែកគ្រប់គ្រងផលិតផល (Product)
Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');

<<<<<<< HEAD
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

Route::get('/admin/purchases', [PurchaseController::class, 'index'])->name('purchase.index');
Route::get('/admin/purchases/create', [PurchaseController::class, 'create'])->name('purchase.create');
Route::post('/admin/purchases', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('/admin/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchase.edit');
Route::put('/admin/purchases/{purchase}', [PurchaseController::class, 'update'])->name('purchase.update');
Route::delete('/admin/purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchase.destroy');
Route::get('/admin/inventory', [StockLogController::class, 'index'])->name('inventory.index');
Route::get('/admin/inventory/create', [StockLogController::class, 'create'])->name('inventory.create');
Route::post('/admin/inventory', [StockLogController::class, 'store'])->name('inventory.store');
Route::get('/admin/inventory/{log}/edit', [StockLogController::class, 'edit'])->name('inventory.edit');
Route::put('/admin/inventory/{log}', [StockLogController::class, 'update'])->name('inventory.update');
Route::delete('/admin/inventory/{log}', [StockLogController::class, 'destroy'])->name('inventory.destroy');

Route::get('/admin/expense-income', [CashTransactionController::class, 'index'])->name('expense_income.index');
Route::get('/admin/expense-income/create', [CashTransactionController::class, 'create'])->name('expense_income.create');
Route::post('/admin/expense-income', [CashTransactionController::class, 'store'])->name('expense_income.store');
Route::get('/admin/expense-income/{expense_income}/edit', [CashTransactionController::class, 'edit'])->name('expense_income.edit');
Route::put('/admin/expense-income/{expense_income}', [CashTransactionController::class, 'update'])->name('expense_income.update');
Route::delete('/admin/expense-income/{expense_income}', [CashTransactionController::class, 'destroy'])->name('expense_income.destroy');
Route::post('/admin/accounting-category', [CashTransactionController::class, 'storeCategory'])->name('accounting-category.store');
Route::delete('/admin/accounting-category/{id}', [CashTransactionController::class, 'destroyCategory'])->name('accounting-category.destroy');

Route::post('/admin/accounting-category', [AccountingCategoryController::class, 'store'])->name('accounting-category.store');
Route::delete('/admin/accounting-category/{category}', [AccountingCategoryController::class, 'destroy'])->name('accounting-category.destroy');
Route::get('/admin/delivery', [DeliveryController::class, 'index'])->name('delivery.index');
Route::get('/admin/delivery/create', [DeliveryController::class, 'create'])->name('delivery.create');
Route::post('/admin/delivery', [DeliveryController::class, 'store'])->name('delivery.store');
Route::get('/admin/delivery/{delivery}/edit', [DeliveryController::class, 'edit'])->name('delivery.edit');
Route::put('/admin/delivery/{delivery}', [DeliveryController::class, 'update'])->name('delivery.update');
Route::delete('/admin/delivery/{delivery}', [DeliveryController::class, 'destroy'])->name('delivery.destroy');

Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/admin/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/admin/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/admin/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/admin/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/admin/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
//web login and register
Route::get('/web/shop', function () {
    return view('website.oder');
});

Route::get('/web/register',[CostumerController::class, 'webRegister'])->name('webRegister');
Route::get('/web/login',[CostumerController::class, 'webLogin'])->name('webLogin');
Route::post('/web/register/proces',[CostumerController::class, 'register'])->name('register');
Route::post('/web/login/proces',[CostumerController::class, 'login'])->name('login');
Route::post('/web/logout', [CostumerController::class, 'logout'])->name('logout');
=======
// ==========================================
// 3. Resource Routes (Categories & Products)
// ==========================================
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
>>>>>>> origin/leap
