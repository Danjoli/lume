<?php

use App\Http\Controllers\Store\Customer\AddressController;
use App\Http\Controllers\Store\Customer\OrderController;
use App\Http\Controllers\Store\Customer\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('minha-conta')
    ->name('store.customer.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Perfil
        |--------------------------------------------------------------------------
        */

        Route::get('/', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::get('/perfil', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/perfil', [ProfileController::class, 'update'])
            ->name('profile.update');

        /*
        |--------------------------------------------------------------------------
        | Endereços
        |--------------------------------------------------------------------------
        */

        Route::prefix('enderecos')
            ->name('addresses.')
            ->group(function () {

                Route::get('/', [AddressController::class, 'index'])
                    ->name('index');

                Route::get('/novo', [AddressController::class, 'create'])
                    ->name('create');

                Route::post('/', [AddressController::class, 'store'])
                    ->name('store');

                Route::get('/{address}/editar', [AddressController::class, 'edit'])
                    ->name('edit');

                Route::put('/{address}', [AddressController::class, 'update'])
                    ->name('update');

                Route::delete('/{address}', [AddressController::class, 'destroy'])
                    ->name('destroy');

                Route::patch('/{address}/principal', [AddressController::class, 'makeDefault'])
                    ->name('default');
            });

        /*
        |--------------------------------------------------------------------------
        | Pedidos
        |--------------------------------------------------------------------------
        */

        Route::prefix('pedidos')
            ->name('orders.')
            ->group(function () {

                Route::get('/', [OrderController::class, 'index'])
                    ->name('index');

                Route::get('/{order}', [OrderController::class, 'show'])
                    ->name('show');
            });
    });
