<?php

namespace App\Actions\Publishers;

use App\Exceptions\Domain\CannotDeletePublisherException;
use App\Models\Publisher;

class DeletePublisherAction
{
    /**
     * Remove uma editora.
     */
    public function execute(
        Publisher $publisher
    ): void {
        if ($publisher->books()->exists()) {
            throw new CannotDeletePublisherException;
        }
        $publisher->delete();
    }
}
