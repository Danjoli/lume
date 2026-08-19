<?php

use App\Http\Controllers\Admin\Notifications\NotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('notifications')
    ->name('notifications.')
    ->group(function () {

        Route::get('/', [NotificationController::class, 'index'])
            ->name('index');

        Route::patch(
            '/read-all',
            [NotificationController::class, 'markAllAsRead']
        )->name('read-all');

        Route::get('/{notification}', [NotificationController::class, 'show'])
            ->name('show');

        Route::patch(
            '/{notification}/read',
            [NotificationController::class, 'markAsRead']
        )->name('read');

        Route::delete(
            '/{notification}',
            [NotificationController::class, 'destroy']
        )->name('destroy');
    });
