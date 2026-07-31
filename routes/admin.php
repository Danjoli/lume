<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Authors\AuthorController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Autenticação
        |--------------------------------------------------------------------------
        */

        Route::middleware('guest:admin')->group(function () {

            Route::get('/login', [LoginController::class, 'create'])
                ->name('login');

            Route::post('/login', [LoginController::class, 'store'])
                ->name('login.store');

        });

        /*
        |--------------------------------------------------------------------------
        | Área Administrativa
        |--------------------------------------------------------------------------
        */

        Route::middleware('admin')->group(function () {

            Route::post('/logout', [LogoutController::class, 'store'])
                ->name('logout');

            Route::get('/dashboard', DashboardController::class)
                ->name('dashboard');

            /*
            |--------------------------------------------------------------------------
            | Cadastros
            |--------------------------------------------------------------------------
            */

            Route::resource('authors', AuthorController::class);

            /*
            |--------------------------------------------------------------------------
            | Rotas temporárias
            |--------------------------------------------------------------------------
            */

            Route::view('/books', 'admin.temp')
                ->name('books.index');

            Route::view('/categories', 'admin.temp')
                ->name('categories.index');

            Route::view('/publishers', 'admin.temp')
                ->name('publishers.index');

            Route::view('/orders', 'admin.temp')
                ->name('orders.index');

            Route::view('/users', 'admin.temp')
                ->name('users.index');

            Route::view('/reviews', 'admin.temp')
                ->name('reviews.index');

            Route::view('/coupons', 'admin.temp')
                ->name('coupons.index');

            Route::view('/reports', 'admin.temp')
                ->name('reports.index');

            Route::view('/settings', 'admin.temp')
                ->name('settings.index');

            Route::view('/profile-edit', 'admin.temp')
                ->name('profile.edit');

        });

    });
