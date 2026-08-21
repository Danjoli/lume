<?php

use App\Http\Controllers\Store\Catalog\PublisherController;
use Illuminate\Support\Facades\Route;

Route::get('/editoras', [PublisherController::class, 'index'])
    ->name('store.publishers.index');

Route::get('/editoras/{publisher}', [PublisherController::class, 'show'])
    ->name('store.publishers.show');
