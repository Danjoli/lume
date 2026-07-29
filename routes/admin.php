<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {

        Route::get('/login', [LoginController::class, 'create'])
            ->name('admin.login');

        Route::post('/login', [LoginController::class, 'store'])
            ->name('admin.login.store');

    });

    Route::middleware('admin')->group(function () {

        Route::post('/logout', [LogoutController::class, 'store'])
            ->name('admin.logout');

        Route::get('/dashboard', DashboardController::class)
            ->name('admin.dashboard');
    });
});
