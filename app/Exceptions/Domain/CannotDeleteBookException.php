<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class CannotDeleteBookException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct(
            'Este livro possui pedidos vinculados e não pode ser removido.'
        );
    }
}
