<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Authors\AuthorController;
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

        Route::resource('authors', AuthorController::class);

        /*
        |--------------------------------------------------------------------------
        | Rotas temporárias
        |--------------------------------------------------------------------------
        */

        Route::view('/books', 'admin.temp')
            ->name('admin.books.index');

        Route::view('/categories', 'admin.temp')
            ->name('admin.categories.index');

        Route::view('/authors', 'admin.temp')
            ->name('admin.authors.index');

        Route::view('/publishers', 'admin.temp')
            ->name('admin.publishers.index');

        Route::view('/orders', 'admin.temp')
            ->name('admin.orders.index');

        Route::view('/users', 'admin.temp')
            ->name('admin.users.index');

        Route::view('/reviews', 'admin.temp')
            ->name('admin.reviews.index');

        Route::view('/coupons', 'admin.temp')
            ->name('admin.coupons.index');

        Route::view('/reports', 'admin.temp')
            ->name('admin.reports.index');

        Route::view('/settings', 'admin.temp')
            ->name('admin.settings.index');

        Route::view('/profile-edit', 'admin.temp')
            ->name('admin.profile.edit');

    });
});
