<?php

use App\Http\Controllers\Store\Customer\Preferences\PreferenceController;
use Illuminate\Support\Facades\Route;

Route::prefix('preferencias')
    ->name('preferences.')
    ->group(function () {

        Route::get('/', [
            PreferenceController::class,
            'index',
        ])->name('index');

        Route::patch('/newsletter', [
            PreferenceController::class,
            'updateNewsletter',
        ])->name('newsletter.update');
    });
