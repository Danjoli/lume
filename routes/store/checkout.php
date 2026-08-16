<?php

use App\Http\Controllers\Store\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::prefix('checkout')
    ->name('store.checkout.')
    ->group(function () {

        Route::get('/', [CheckoutController::class, 'index'])
            ->name('index');

        Route::post('/', [CheckoutController::class, 'store'])
            ->name('store');

        Route::get('/sucesso/{order}', [CheckoutController::class, 'success'])
            ->name('success');
    });
