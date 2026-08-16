<?php

use App\Http\Controllers\Admin\Reviews\ReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('reviews')
    ->name('reviews.')
    ->group(function () {

        Route::get('/', [ReviewController::class, 'index'])
            ->name('index');

        Route::get('/{review}', [ReviewController::class, 'show'])
            ->name('show');

        Route::patch('/{review}/approve', [ReviewController::class, 'approve'])
            ->name('approve');

        Route::patch('/{review}/reject', [ReviewController::class, 'reject'])
            ->name('reject');

        Route::delete('/{review}', [ReviewController::class, 'destroy'])
            ->name('destroy');

    });
