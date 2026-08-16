<?php

namespace App\Actions\Orders;

use App\Data\Orders\OrderData;
use App\Models\Order;

class CreateOrderAction
{
    /**
     * Cria um pedido.
     */
    public function execute(
        OrderData $data
    ): Order {

        return Order::create(
            $data->toArray()
        );

    }
}
