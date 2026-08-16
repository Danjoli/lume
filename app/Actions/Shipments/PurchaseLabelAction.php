<?php

namespace App\Actions\Shipments;

use App\Exceptions\Domain\CannotPurchaseShipmentException;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class PurchaseLabelAction
{
    /**
     * Compra a etiqueta do envio.
     */
    public function execute(
        Shipment $shipment
    ): Shipment {

        if (! $shipment->isPreparing()) {

            throw new CannotPurchaseShipmentException();

        }

        return DB::transaction(function () use ($shipment) {

            /*
            |--------------------------------------------------------------------------
            | Futuramente:
            | MelhorEnvioService->purchaseLabel($shipment)
            |--------------------------------------------------------------------------
            */

            // Exemplo:
            //
            // $this->melhorEnvioService->purchaseLabel($shipment);

            return $shipment->refresh();

        });

    }
}
