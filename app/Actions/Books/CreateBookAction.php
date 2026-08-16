<?php

namespace App\Actions\Books;

use App\Data\Books\BookData;
use App\Models\Book;

class CreateBookAction
{
    /**
     * Cria um livro.
     */
    public function execute(
        BookData $data
    ): Book {

        return Book::create(
            $data->toArray()
        );

    }
}
