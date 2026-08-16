<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class CannotDeletePublisherException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct(
            'Esta editora possui livros cadastrados e não pode ser removida.'
        );
    }
}
