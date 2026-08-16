<?php

namespace App\Actions\Books\Images;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class DeleteBookImagesAction
{
    /**
     * Remove todas as imagens do livro.
     */
    public function execute(
        Book $book
    ): void {

        foreach ($book->images as $image) {

            Storage::disk('public')
                ->delete($image->path);

        }

        $book->images()->delete();

    }
}
