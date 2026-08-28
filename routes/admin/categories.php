<?php

use App\Http\Controllers\Admin\Categories\CategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoryController::class)
    ->middlewareFor('index', 'can:viewAny,'.Category::class)
    ->middlewareFor(['create', 'store'], 'can:create,'.Category::class)
    ->middlewareFor('show', 'can:view,category')
    ->middlewareFor(['edit', 'update'], 'can:update,category')
    ->middlewareFor('destroy', 'can:delete,category');
