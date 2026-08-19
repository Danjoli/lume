<?php

namespace App\Data\Shipments;

use App\Enums\ShipmentStatus;
use App\Http\Requests\Admin\Shipments\UpdateShipmentRequest;

readonly class ShipmentData
{
    public function __construct(
        public string $carrier,
        public ?string $trackingCode,
        public string $service,
        public ShipmentStatus $status,
        public float $shippingCost,
    ) {
    }

    /**
     * Cria um DTO a partir do Form Request.
     */
    public static function fromRequest(
        UpdateShipmentRequest $request
    ): self {

        return new self(

            carrier: $request->string('carrier')->toString(),

            trackingCode: $request->filled('tracking_code')
                ? $request->string('tracking_code')->toString()
                : null,

            service: $request->string('service')->toString(),

            status: ShipmentStatus::from(
                $request->string('status')->toString()
            ),

            shippingCost: (float) $request->input('shipping_cost'),

        );

    }

    /**
     * Converte o DTO para array.
     */
    public function toArray(): array
    {
        return [
            'carrier' => $this->carrier,
            'tracking_code' => $this->trackingCode,
            'service' => $this->service,
            'status' => $this->status,
            'shipping_cost' => $this->shippingCost,
        ];
    }
}
