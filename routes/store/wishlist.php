<?php

use App\Http\Controllers\Store\WishlistController;
use Illuminate\Support\Facades\Route;

Route::prefix('wishlist')
    ->name('store.wishlist.')
    ->group(function () {

        Route::get('/', [WishlistController::class, 'index'])
            ->name('index');

        Route::post('/{book}', [WishlistController::class, 'store'])
            ->name('store');

        Route::delete('/{book}', [WishlistController::class, 'destroy'])
            ->name('destroy');
    });
