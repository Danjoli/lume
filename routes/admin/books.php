<?php

use App\Http\Controllers\Admin\Books\BookController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::resource('books', BookController::class)
    ->middlewareFor('index', 'can:viewAny,'.Book::class)
    ->middlewareFor(['create', 'store'], 'can:create,'.Book::class)
    ->middlewareFor('show', 'can:view,book')
    ->middlewareFor(['edit', 'update'], 'can:update,book')
    ->middlewareFor('destroy', 'can:delete,book');
