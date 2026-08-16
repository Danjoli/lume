<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class CannotDeactivateUserException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct(
            'Este usuário possui pedidos em andamento e não pode ser desativado.'
        );
    }
}
