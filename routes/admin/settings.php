<?php

use App\Http\Controllers\Admin\Settings\MelhorEnvioOAuthController;
use App\Http\Controllers\Admin\Settings\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')
    ->name('settings.')
    ->group(function () {

        Route::get('/edit', [SettingController::class, 'edit'])
            ->name('edit');

        Route::put('/', [SettingController::class, 'update'])
            ->name('update');

        Route::get('/integrations/melhor-envio/connect', [MelhorEnvioOAuthController::class, 'connect'])
            ->name('melhor-envio.connect');

        Route::get('/integrations/melhor-envio/callback', [MelhorEnvioOAuthController::class, 'callback'])
            ->name('melhor-envio.callback');

        Route::delete('/integrations/melhor-envio', [MelhorEnvioOAuthController::class, 'disconnect'])
            ->name('melhor-envio.disconnect');
    });
