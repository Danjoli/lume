<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class CannotDeleteAdminException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct(
            'Você não pode excluir sua própria conta de administrador.'
        );
    }
}
