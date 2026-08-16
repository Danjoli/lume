<?php

namespace App\Actions\Books;

use App\Data\Books\BookData;
use App\Models\Book;

class UpdateBookAction
{
    /**
     * Atualiza um livro.
     */
    public function execute(
        Book $book,
        BookData $data
    ): Book {

        $book->update(
            $data->toArray()
        );

        return $book->refresh();

    }
}
