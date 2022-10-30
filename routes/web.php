<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.master');
});

Route::controller(LoginController::class)->prefix('login')->name('login.')->group(function () {
    Route::get('/', 'loginForm')->name('form');
    Route::post('/store', 'login')->name('store');
});
Route::controller(LoginController::class)->prefix('logout')->group(function () {
    Route::post('/', 'logout')->name('logout');
});
Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});
