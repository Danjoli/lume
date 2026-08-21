<?php

use App\Http\Controllers\Admin\Auth\EntryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', EntryController::class)
            ->name('entry');

        require __DIR__.'/auth.php';

        Route::middleware('admin')
            ->group(function () {

                require __DIR__.'/dashboard.php';
                require __DIR__.'/authors.php';
                require __DIR__.'/publishers.php';
                require __DIR__.'/categories.php';
                require __DIR__.'/books.php';
                require __DIR__.'/admins.php';
                require __DIR__.'/orders.php';
                require __DIR__.'/users.php';
                require __DIR__.'/reviews.php';
                require __DIR__.'/coupons.php';
                require __DIR__.'/reports.php';
                require __DIR__.'/settings.php';
                require __DIR__.'/shipments.php';
                require __DIR__.'/profile.php';
                require __DIR__.'/notifications.php';
                require __DIR__.'/contact.php';
                require __DIR__.'/newsletter.php';
            });
    });
