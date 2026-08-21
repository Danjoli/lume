<?php

use App\Http\Controllers\Store\Shopping\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('carrinho')
    ->name('store.cart.')
    ->group(function () {

        Route::get('/', [CartController::class, 'index'])
            ->name('index');

        Route::post('/items', [CartController::class, 'add'])
            ->name('add');

        Route::post('/items/toggle', [CartController::class, 'toggle'])
            ->name('toggle');

        Route::patch('/items/{cartItem}', [CartController::class, 'update'])
            ->name('update');

        Route::delete('/items/{cartItem}', [CartController::class, 'destroy'])
            ->name('destroy');

        Route::delete('/', [CartController::class, 'clear'])
            ->name('clear');
    });
