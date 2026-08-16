<?php

use App\Http\Controllers\Store\BookController;
use App\Http\Controllers\Store\CatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/livros', [CatalogController::class, 'index'])
    ->name('store.catalog.index');

Route::get('/livros/{book}', [BookController::class, 'show'])
    ->name('store.books.show');
