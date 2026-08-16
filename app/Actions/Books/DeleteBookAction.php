<?php

namespace App\Actions\Books;

use App\Models\Book;

class DeleteBookAction
{
    /**
     * Remove um livro.
     */
    public function execute(
        Book $book
    ): void {

        $book->delete();

    }
}
