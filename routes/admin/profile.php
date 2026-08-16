<?php

use App\Http\Controllers\Admin\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')
    ->name('profile.')
    ->group(function () {

        Route::get('/edit', [ProfileController::class, 'edit'])
            ->name('edit');

        Route::put('/', [ProfileController::class, 'update'])
            ->name('update');
    });


