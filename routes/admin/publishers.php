<?php

use App\Http\Controllers\Admin\Publishers\PublisherController;
use App\Models\Publisher;
use Illuminate\Support\Facades\Route;

Route::resource('publishers', PublisherController::class)
    ->middlewareFor('index', 'can:viewAny,'.Publisher::class)
    ->middlewareFor(['create', 'store'], 'can:create,'.Publisher::class)
    ->middlewareFor('show', 'can:view,publisher')
    ->middlewareFor(['edit', 'update'], 'can:update,publisher')
    ->middlewareFor('destroy', 'can:delete,publisher');
