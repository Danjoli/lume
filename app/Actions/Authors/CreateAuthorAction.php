<?php

namespace App\Actions\Authors;

use App\Data\Authors\AuthorData;
use App\Models\Author;

class CreateAuthorAction
{
    /**
     * Cria um novo autor.
     */
    public function execute(
        AuthorData $data
    ): Author {

        return Author::create(
            $data->toArray()
        );

    }
}
