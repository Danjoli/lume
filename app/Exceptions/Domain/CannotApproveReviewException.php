<?php

namespace App\Exceptions\Domain;

use RuntimeException;

class CannotApproveReviewException extends RuntimeException
{
    public function __construct(
        string $message = 'Não foi possível aprovar a avaliação.'
    ) {
        parent::__construct($message);
    }
}
