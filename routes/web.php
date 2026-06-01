<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Public Storefront & Booking Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order_number}', [CheckoutController::class, 'success'])->name('checkout.success');

// 2. Public Order Tracking
Route::get('/track', [OrderTrackingController::class, 'index'])->name('track.index');
Route::post('/track', [OrderTrackingController::class, 'search'])->name('track.search');

// 3. Admin Authentication Entries
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard analytics
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Store customization parameters
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    // Category management CRUD
    Route::resource('categories', CategoryController::class)->except(['show', 'create']);
    
    // Inventory management CRUD
    Route::resource('products', ProductController::class)->except(['show', 'create']);
    
    // Booking orders registry & transport logs
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'printInvoice'])->name('orders.invoice');
});
