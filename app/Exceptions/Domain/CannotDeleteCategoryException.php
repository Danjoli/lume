<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class CannotDeleteCategoryException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct(
            'Esta categoria possui livros cadastrados e não pode ser removida.'
        );
    }
}
