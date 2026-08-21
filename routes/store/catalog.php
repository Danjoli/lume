<?php

use App\Http\Controllers\Store\Catalog\BookController;
use App\Http\Controllers\Store\Catalog\CatalogController;
use App\Http\Controllers\Store\Catalog\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/livros', [CatalogController::class, 'index'])
    ->name('store.catalog.index');

Route::get('/livros/{book}', [BookController::class, 'show'])
    ->name('store.books.show');

Route::middleware('auth')->group(function () {
    Route::post('/livros/{book}/avaliacoes', [ReviewController::class, 'store'])->name('store.books.reviews.store');
    Route::delete('/avaliacoes/{review}', [ReviewController::class, 'destroy'])->name('store.reviews.destroy');
});
