<?php

namespace App\Actions\Shipments;

use App\Enums\ShipmentStatus;
use App\Exceptions\Domain\InvalidShipmentStatusException;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class ShipShipmentAction
{
    /**
     * Marca o envio como enviado.
     */
    public function execute(
        Shipment $shipment
    ): Shipment {

        if ($shipment->status !== ShipmentStatus::PREPARING) {

            throw new InvalidShipmentStatusException(
                'O envio não pode ser marcado como enviado.'
            );

        }

        return DB::transaction(function () use ($shipment) {

            $shipment->update([

                'status' => ShipmentStatus::SHIPPED,

                'shipped_at' => now(),

            ]);

            return $shipment->refresh();

        });

    }
}
