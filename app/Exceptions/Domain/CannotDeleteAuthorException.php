<?php

namespace App\Exceptions\Domain;

use Exception;

class CannotDeleteAuthorException extends Exception
{
    /**
     * Cria uma nova exceção.
     */
    public function __construct(
        string $message = 'Este autor possui livros cadastrados e não pode ser removido.'
    ) {
        parent::__construct($message);
    }
}
