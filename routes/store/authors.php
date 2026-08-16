<?php

use App\Http\Controllers\Store\AuthorController;
use Illuminate\Support\Facades\Route;

Route::get('/autores', [AuthorController::class, 'index'])
    ->name('store.authors.index');

Route::get('/autores/{author}', [AuthorController::class, 'show'])
    ->name('store.authors.show');
