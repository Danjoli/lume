<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class CannotGenerateLabelException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct(
            'Não é possível gerar a etiqueta para este envio.'
        );
    }
}
