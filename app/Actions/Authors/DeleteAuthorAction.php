<?php

namespace App\Actions\Authors;

use App\Exceptions\Domain\CannotDeleteAuthorException;
use App\Models\Author;

class DeleteAuthorAction
{
    /**
     * Remove um autor.
     */
    public function execute(
        Author $author
    ): void {

        if ($author->books()->exists()) {

            throw new CannotDeleteAuthorException();

        }

        $author->delete();

    }
}
