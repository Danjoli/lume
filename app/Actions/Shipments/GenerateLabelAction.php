<?php

namespace App\Actions\Shipments;

use App\Enums\ShipmentStatus;
use App\Exceptions\Domain\CannotGenerateLabelException;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class GenerateLabelAction
{
    /**
     * Gera a etiqueta do envio.
     */
    public function execute(
        Shipment $shipment
    ): Shipment {

        if (! $shipment->canGenerateLabel()) {

            throw new CannotGenerateLabelException();

        }

        return DB::transaction(function () use ($shipment) {

            /*
            |--------------------------------------------------------------------------
            | Futuramente:
            | MelhorEnvioService->generateLabel($shipment)
            |--------------------------------------------------------------------------
            */

            $shipment->update([

                'status' => ShipmentStatus::PREPARING,

            ]);

            return $shipment->refresh();

        });

    }
}
