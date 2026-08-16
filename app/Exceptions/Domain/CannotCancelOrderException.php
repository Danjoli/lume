<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class CannotCancelOrderException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct(
            'Este pedido não pode mais ser cancelado.'
        );
    }
}
