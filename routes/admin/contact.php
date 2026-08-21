<?php

use App\Http\Controllers\Admin\Contact\ContactMessageController;
use Illuminate\Support\Facades\Route;

Route::prefix('atendimentos')
    ->name('contact-messages.')
    ->group(function () {

        Route::get('/', [
            ContactMessageController::class,
            'index',
        ])->name('index');

        Route::get('/{contactMessage}', [
            ContactMessageController::class,
            'show',
        ])->name('show');

        Route::patch('/{contactMessage}/status', [
            ContactMessageController::class,
            'updateStatus',
        ])->name('update-status');
    });
