<?php

use App\Http\Controllers\Store\Shopping\CheckoutController;
use App\Http\Controllers\Store\Shopping\PaymentController;
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

        Route::get('/pagamento/{order}', [PaymentController::class, 'show'])
            ->name('payment');

        Route::post('/pagamento/{order}/tentar-novamente', [PaymentController::class, 'retry'])
            ->name('payment.retry');
    });
