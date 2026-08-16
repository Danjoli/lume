<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class InvalidBookImageException extends RuntimeException
{
    public function __construct(
        string $message = 'Imagem inválida.'
    ) {
        parent::__construct($message);
    }
}
