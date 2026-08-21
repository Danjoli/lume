<?php

use App\Http\Controllers\Admin\Shipments\ShipmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('shipments')
    ->name('shipments.')
    ->group(function () {

        Route::get('/', [ShipmentController::class, 'index'])
            ->name('index');

        Route::get('/{shipment}', [ShipmentController::class, 'show'])
            ->name('show');

        Route::put('/{shipment}', [ShipmentController::class, 'update'])
            ->name('update');

        Route::patch('/{shipment}/generate-label', [ShipmentController::class, 'generateLabel'])
            ->name('generate-label');

        Route::patch('/{shipment}/purchase-label', [ShipmentController::class, 'purchaseLabel'])
            ->name('purchase-label');

        Route::patch('/{shipment}/tracking', [ShipmentController::class, 'tracking'])
            ->name('tracking');

        Route::patch('/{shipment}/ship', [ShipmentController::class, 'ship'])
            ->name('ship');

        Route::patch('/{shipment}/deliver', [ShipmentController::class, 'deliver'])
            ->name('deliver');

        Route::patch('/{shipment}/return', [ShipmentController::class, 'return'])
            ->name('return');

        Route::patch('/{shipment}/cancel', [ShipmentController::class, 'cancel'])
            ->name('cancel');

    });
