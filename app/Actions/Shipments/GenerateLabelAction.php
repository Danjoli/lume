<?php

namespace App\Actions\Shipments;

use App\Enums\ShipmentStatus;
use App\Exceptions\Domain\CannotGenerateLabelException;
use App\Models\Shipment;
use App\Services\Store\Shipping\MelhorEnvioService;
use Illuminate\Support\Facades\DB;

class GenerateLabelAction
{
    public function __construct(private readonly MelhorEnvioService $melhorEnvio) {}

    /**
     * Gera a etiqueta do envio.
     */
    public function execute(
        Shipment $shipment
    ): Shipment {

        if (! $shipment->canGenerateLabel()) {

            throw new CannotGenerateLabelException;
        }

        return DB::transaction(function () use ($shipment) {

            $result = $this->melhorEnvio->addToCart($shipment);

            $shipment->update([
                'melhor_envio_order_id' => $result['id'] ?? $result['order']['id'] ?? null,
                'melhor_envio_protocol' => $result['protocol'] ?? null,
                'status' => ShipmentStatus::PREPARING,
            ]);

            return $shipment->refresh();

        });

    }
}
