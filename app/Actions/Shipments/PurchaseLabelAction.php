<?php

namespace App\Actions\Shipments;

use App\Exceptions\Domain\CannotPurchaseShipmentException;
use App\Models\Shipment;
use App\Services\Store\Shipping\MelhorEnvioService;
use Illuminate\Support\Facades\DB;

class PurchaseLabelAction
{
    public function __construct(private readonly MelhorEnvioService $melhorEnvio) {}

    /**
     * Compra a etiqueta do envio.
     */
    public function execute(
        Shipment $shipment
    ): Shipment {

        if (! $shipment->canPurchaseLabel()) {

            throw new CannotPurchaseShipmentException;
        }

        return DB::transaction(function () use ($shipment) {

            $this->melhorEnvio->purchase($shipment);
            $generated = $this->melhorEnvio->generate($shipment);
            $shipment->update([
                'tracking_code' => data_get($generated, '0.tracking') ?? data_get($generated, 'tracking'),
                'label_url' => $this->melhorEnvio->printUrl($shipment),
            ]);

            return $shipment->refresh();

        });

    }
}
