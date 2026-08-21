<?php

use App\Http\Controllers\Store\Catalog\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/categorias', [CategoryController::class, 'index'])
    ->name('store.categories.index');

Route::get('/categorias/{category}', [CategoryController::class, 'show'])
    ->name('store.categories.show');
