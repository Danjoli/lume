<?php

namespace App\Actions\Shipments;

use App\Enums\ShipmentStatus;
use App\Exceptions\Domain\InvalidShipmentStatusException;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class ReturnShipmentAction
{
    /**
     * Marca o envio como devolvido.
     */
    public function execute(
        Shipment $shipment
    ): Shipment {

        if ($shipment->status !== ShipmentStatus::DELIVERED) {

            throw new InvalidShipmentStatusException(
                'O envio não pode ser marcado como devolvido.'
            );

        }

        return DB::transaction(function () use ($shipment) {

            $shipment->update([

                'status' => ShipmentStatus::RETURNED,

            ]);

            return $shipment->refresh();

        });

    }
}
