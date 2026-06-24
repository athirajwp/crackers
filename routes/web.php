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
use App\Http\Controllers\Admin\BrandingController;
use App\Http\Controllers\Admin\ProfileController;
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
Route::view('/about', 'about')->name('about');
Route::view('/terms', 'terms')->name('terms');
Route::get('/price_list', [HomeController::class, 'priceList'])->name('price_list');
Route::get('/price-list', [HomeController::class, 'priceList']);

// 2. Public Order Tracking
Route::get('/track', [OrderTrackingController::class, 'index'])->name('track.index');
Route::post('/track', [OrderTrackingController::class, 'search'])->name('track.search');

// 3. Admin Authentication Entries
Route::get('/admin', function (\Illuminate\Http\Request $request) {
    return redirect()->route('admin.login', $request->query());
});
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard analytics
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Store customization parameters
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Site Branding customization parameters
    Route::get('/branding', [BrandingController::class, 'index'])->name('branding.index');
    Route::post('/branding', [BrandingController::class, 'update'])->name('branding.update');

    // Admin Profile settings & Password Change
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Category management CRUD
    Route::resource('categories', CategoryController::class)->except(['show', 'create']);
    
    // Inventory management CRUD
    Route::resource('products', ProductController::class)->except(['show', 'create']);
    
    // Booking orders registry & transport logs
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit-items', [OrderController::class, 'editItems'])->name('orders.edit_items');
    Route::put('/orders/{order}/edit-items', [OrderController::class, 'updateItems'])->name('orders.update_items');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'printInvoice'])->name('orders.invoice');
});

// 4. Super Admin Multi-Domain Panel Routing Group
Route::prefix('admin_sys')->name('admin_sys.')->group(function () {
    // Auth routes
    Route::get('/login', [\App\Http\Controllers\AdminSys\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AdminSys\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [\App\Http\Controllers\AdminSys\AuthController::class, 'logout'])->name('logout');

    // Protected routes
    Route::middleware(['super_admin.auth'])->group(function () {
        Route::get('/company', [\App\Http\Controllers\AdminSys\CompanyController::class, 'index'])->name('company.index');
        Route::post('/company', [\App\Http\Controllers\AdminSys\CompanyController::class, 'store'])->name('company.store');
        Route::post('/company/{id}/update', [\App\Http\Controllers\AdminSys\CompanyController::class, 'update'])->name('company.update');
        Route::post('/company/{id}/toggle-status', [\App\Http\Controllers\AdminSys\CompanyController::class, 'toggleStatus'])->name('company.toggle_status');
        Route::delete('/company/{id}', [\App\Http\Controllers\AdminSys\CompanyController::class, 'destroy'])->name('company.destroy');

        // Super Admin Profile Management
        Route::get('/profile', [\App\Http\Controllers\AdminSys\ProfileController::class, 'edit'])->name('profile');
        Route::post('/profile', [\App\Http\Controllers\AdminSys\ProfileController::class, 'update'])->name('profile.update');
    });
});
