<?php

namespace App\Actions\Shipments;

use App\Enums\ShipmentStatus;
use App\Exceptions\Domain\InvalidShipmentStatusException;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class CancelShipmentAction
{
    /**
     * Cancela um envio.
     */
    public function execute(
        Shipment $shipment
    ): Shipment {

        if (! $shipment->canBeCancelled()) {

            throw new InvalidShipmentStatusException(
                'O envio não pode ser cancelado.'
            );

        }

        return DB::transaction(function () use ($shipment) {

            $shipment->update([

                'status' => ShipmentStatus::CANCELLED,

            ]);

            return $shipment->refresh();

        });

    }
}
