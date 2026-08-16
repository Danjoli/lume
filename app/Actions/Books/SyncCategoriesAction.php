<?php

namespace App\Actions\Books;

use App\Models\Book;

class SyncCategoriesAction
{
    /**
     * Sincroniza as categorias.
     *
     * @param array<int> $categories
     */
    public function execute(
        Book $book,
        array $categories
    ): void {

        $book->categories()->sync(
            $categories
        );

    }
}
