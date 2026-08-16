<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class CannotPurchaseShipmentException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct(
            'Não foi possível comprar a etiqueta deste envio.'
        );
    }
}
