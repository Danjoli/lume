<?php

namespace App\Actions\Books;

use App\Models\Book;

class SyncAuthorsAction
{
    /**
     * Sincroniza os autores.
     *
     * @param array<int> $authors
     */
    public function execute(
        Book $book,
        array $authors
    ): void {

        $book->authors()->sync(
            $authors
        );

    }
}
