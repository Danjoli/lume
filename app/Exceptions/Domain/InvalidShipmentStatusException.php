<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class InvalidShipmentStatusException extends RuntimeException
{
    public function __construct(
        string $message = 'Status do envio inválido.'
    ) {
        parent::__construct($message);
    }
}
