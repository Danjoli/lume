<?php

use App\Http\Controllers\Store\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('carrinho')
    ->name('store.cart.')
    ->group(function () {

        Route::get('/', [CartController::class, 'index'])
            ->name('index');

        Route::post('/items', [CartController::class, 'store'])
            ->name('store');

        Route::patch('/items/{cartItem}', [CartController::class, 'update'])
            ->name('update');

        Route::delete('/items/{cartItem}', [CartController::class, 'destroy'])
            ->name('destroy');

        Route::delete('/', [CartController::class, 'clear'])
            ->name('clear');
    });
