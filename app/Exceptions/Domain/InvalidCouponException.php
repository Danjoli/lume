<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class InvalidCouponException extends RuntimeException
{
    public function __construct(
        string $message = 'Cupom inválido.'
    ) {
        parent::__construct($message);
    }
}
