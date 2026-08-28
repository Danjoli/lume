<?php

use App\Http\Controllers\Admin\Authors\AuthorController;
use App\Models\Author;
use Illuminate\Support\Facades\Route;

Route::resource('authors', AuthorController::class)
    ->middlewareFor('index', 'can:viewAny,'.Author::class)
    ->middlewareFor(['create', 'store'], 'can:create,'.Author::class)
    ->middlewareFor('show', 'can:view,author')
    ->middlewareFor(['edit', 'update'], 'can:update,author')
    ->middlewareFor('destroy', 'can:delete,author');
