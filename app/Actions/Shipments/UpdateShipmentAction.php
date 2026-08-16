<?php

namespace App\Actions\Shipments;

use App\Data\Shipments\ShipmentData;
use App\Models\Shipment;

class UpdateShipmentAction
{
    /**
     * Atualiza um envio.
     */
    public function execute(
        Shipment $shipment,
        ShipmentData $data
    ): Shipment {

        $shipment->update(
            $data->toArray()
        );

        return $shipment->refresh();

    }
}
