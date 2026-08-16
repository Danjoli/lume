<?php

namespace App\Actions\Books\Images;

use App\Models\Book;

class SetPrimaryBookImageAction
{
    /**
     * Define uma imagem como principal.
     */
    public function execute(
        Book $book,
        int $imageId
    ): void {

        $book->images()->update([

            'is_primary' => false,

        ]);

        $book->images()

            ->whereKey($imageId)

            ->update([

                'is_primary' => true,

            ]);

    }
}
