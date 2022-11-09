<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
});

Route::controller(WebsiteController::class)->name('web.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::post('/checkout/store', 'storeCheckout')->name('checkout.store');
    Route::get('/more', 'more')->name('more');
});

Route::controller(LoginController::class)->prefix('login')->group(function () {
    Route::get('/', 'loginForm')->name('loginForm');
    Route::post('/login', 'login')->name('login.store');
});

Route::controller(LoginController::class)->prefix('logout')->group(function () {
    Route::post('/', 'logout')->name('logout');
});

Route::controller(StorageController::class)->name('storage.')->group(function () {
    Route::get('/category-thumbnail/{filename}', 'categoryThumbnail')->name('categoryThumbnail');
    Route::get('/product-thumbnail/{filename}', 'productThumbnail')->name('productThumbnail');
    Route::get('/setting-logo/{filename}', 'settingLogo')->name('settingLogo');
    Route::get('/banner-image/{filename}', 'bannerImage')->name('bannerImage');
});

Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::controller(AccountController::class)->prefix('account')->name('account.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{id}/update', 'update')->name('update');
    });
    Route::controller(BannerController::class)->prefix('banner')->name('banner.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/{id}/update', 'update')->name('update');
        Route::get('/{id}/destroy', 'destroy')->name('destroy');
    });
    Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/{id}/update', 'update')->name('update');
        Route::get('/{id}/destroy', 'destroy')->name('destroy');
    });
    Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/{id}/update', 'update')->name('update');
        Route::get('/{id}/destroy', 'destroy')->name('destroy');
    });
    Route::controller(SettingsController::class)->prefix('setting')->name('setting.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{id}/update', 'update')->name('update');
        // Route::post('/store', 'store')->name('store');
        // Route::get('/{id}/destroy', 'destroy')->name('destroy');
    });
});
