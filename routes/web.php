<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
});

Route::controller(WebsiteController::class)->name('web.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(LoginController::class)->prefix('logout')->group(function () {
    Route::post('/', 'logout')->name('logout');
});

Route::controller(StorageController::class)->name('storage.')->group(function () {
    Route::get('/category-thumbnail/{filename}', 'categoryThumbnail')->name('categoryThumbnail');
    Route::get('/product-thumbnail/{filename}', 'productThumbnail')->name('productThumbnail');
});

Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::controller(AccountController::class)->prefix('account')->name('account.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{id}/update', 'update')->name('update');
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
});
