<?php

use App\Http\Controllers\Store\Content\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('store.home');
