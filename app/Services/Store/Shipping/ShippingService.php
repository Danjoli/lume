<?php

namespace App\Services\Store\Shipping;

use App\Models\Address;
use App\Models\Cart;
use Illuminate\Support\Collection;

class ShippingService
{
    public function __construct(
        private readonly MelhorEnvioService $melhorEnvioService
    ) {}

    public function calculate(
        Address $address,
        Cart $cart
    ): Collection {
        return $this->melhorEnvioService->calculate(
            $address,
            $cart
        );
    }
}
