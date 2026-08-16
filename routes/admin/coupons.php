<?php

use App\Http\Controllers\Admin\Coupons\CouponController;
use Illuminate\Support\Facades\Route;

Route::prefix('coupons')
    ->name('coupons.')
    ->group(function () {

        Route::get('/', [CouponController::class, 'index'])
            ->name('index');

        Route::get('/create', [CouponController::class, 'create'])
            ->name('create');

        Route::post('/', [CouponController::class, 'store'])
            ->name('store');

        Route::get('/{coupon}', [CouponController::class, 'show'])
            ->name('show');

        Route::get('/{coupon}/edit', [CouponController::class, 'edit'])
            ->name('edit');

        Route::put('/{coupon}', [CouponController::class, 'update'])
            ->name('update');

        Route::delete('/{coupon}', [CouponController::class, 'destroy'])
            ->name('destroy');

        Route::patch('/{coupon}/activate', [CouponController::class, 'activate'])
            ->name('activate');

        Route::patch('/{coupon}/deactivate', [CouponController::class, 'deactivate'])
            ->name('deactivate');

    });
