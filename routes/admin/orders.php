<?php

use App\Http\Controllers\Admin\Orders\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('orders')
    ->name('orders.')
    ->group(function () {

        Route::get('/', [OrderController::class, 'index'])
            ->name('index');

        Route::get('/{order}', [OrderController::class, 'show'])
            ->name('show');

        Route::patch('/{order}/paid', [OrderController::class, 'markAsPaid'])
            ->name('paid');

        Route::patch('/{order}/process', [OrderController::class, 'process'])
            ->name('process');

        Route::patch('/{order}/ship', [OrderController::class, 'ship'])
            ->name('ship');

        Route::patch('/{order}/deliver', [OrderController::class, 'deliver'])
            ->name('deliver');

        Route::patch('/{order}/cancel', [OrderController::class, 'cancel'])
            ->name('cancel');

        Route::patch('/{order}/refund', [OrderController::class, 'refund'])
            ->name('refund');
    });
