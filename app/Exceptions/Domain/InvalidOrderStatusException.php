<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class InvalidOrderStatusException extends RuntimeException
{
    public function __construct(
        string $message = 'Status do pedido inválido.'
    ) {
        parent::__construct($message);
    }
}
