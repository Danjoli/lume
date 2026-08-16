<?php

namespace App\Actions\Authors;

use App\Data\Authors\AuthorData;
use App\Models\Author;

class UpdateAuthorAction
{
    /**
     * Atualiza um autor.
     */
    public function execute(
        Author $author,
        AuthorData $data
    ): Author {

        $author->update(
            $data->toArray()
        );

        return $author->refresh();

    }
}
