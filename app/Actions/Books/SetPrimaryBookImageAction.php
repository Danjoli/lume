<?php

namespace App\Actions\Books;

use App\Models\Book;
use App\Models\BookImage;
use Illuminate\Support\Facades\DB;

class SetPrimaryBookImageAction
{
    /**
     * Define uma imagem como principal.
     */
    public function execute(
        Book $book,
        int $imageId
    ): BookImage {
        return DB::transaction(function () use ($book, $imageId): BookImage {
            $image = $book->images()->findOrFail($imageId);

            $book->images()
                ->where('id', '!=', $image->id)
                ->update(['is_primary' => false]);

            $image->update(['is_primary' => true]);

            return $image->refresh();
        });
    }
}
