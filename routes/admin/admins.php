<?php

use App\Http\Controllers\Admin\Admins\AdminController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

Route::resource('admins', AdminController::class)
    ->middlewareFor('index', 'can:viewAny,'.Admin::class)
    ->middlewareFor(['create', 'store'], 'can:create,'.Admin::class)
    ->middlewareFor('show', 'can:view,admin')
    ->middlewareFor(['edit', 'update'], 'can:update,admin')
    ->middlewareFor('destroy', 'can:delete,admin');
