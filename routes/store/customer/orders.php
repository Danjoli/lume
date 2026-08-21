<?php

use App\Http\Controllers\Store\Customer\Orders\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('pedidos')->name('orders.')->controller(OrderController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{order}', 'show')->name('show');
});
