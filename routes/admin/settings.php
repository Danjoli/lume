<?php

use App\Http\Controllers\Admin\Settings\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')
    ->name('settings.')
    ->group(function () {

        Route::get('/edit', [SettingController::class, 'edit'])
            ->name('edit');

        Route::put('/', [SettingController::class, 'update'])
            ->name('update');
    });
