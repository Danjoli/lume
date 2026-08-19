<?php

namespace App\Services\Store\Shipping;

use App\Models\Address;
use App\Models\Cart;
use Illuminate\Support\Collection;

class MelhorEnvioService
{
    public function calculate(
        Address $address,
        Cart $cart
    ): Collection {
        // Próximo passo:
        // montar payload
        // chamar API Melhor Envio
        // normalizar resposta

        return collect();
    }
}
