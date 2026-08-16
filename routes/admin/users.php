<?php

use App\Http\Controllers\Admin\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->name('users.')
    ->group(function () {

        Route::get('/', [UserController::class, 'index'])
            ->name('index');

        Route::get('/{user}', [UserController::class, 'show'])
            ->name('show');

        Route::get('/{user}/edit', [UserController::class, 'edit'])
            ->name('edit');

        Route::put('/{user}', [UserController::class, 'update'])
            ->name('update');

        Route::patch('/{user}/activate', [UserController::class, 'activate'])
            ->name('activate');

        Route::patch('/{user}/deactivate', [UserController::class, 'deactivate'])
            ->name('deactivate');

        Route::patch('/{user}/block', [UserController::class, 'block'])
            ->name('block');

        Route::delete('/users/{user}',[UserController::class, 'destroy'])
            ->name('destroy');
    });
