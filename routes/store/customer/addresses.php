<?php

use App\Http\Controllers\Store\Customer\Addresses\AddressController;
use Illuminate\Support\Facades\Route;

Route::prefix('enderecos')->name('addresses.')->controller(AddressController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/novo', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{address}/editar', 'edit')->name('edit');
    Route::put('/{address}', 'update')->name('update');
    Route::delete('/{address}', 'destroy')->name('destroy');
    Route::patch('/{address}/principal', 'makeDefault')->name('default');
});
