<?php

namespace App\Actions\Books;

use App\Exceptions\Domain\InvalidBookImageException;
use App\Models\Book;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadBookImagesAction
{
    /**
     * Salva as imagens do livro.
     *
     * @param  array<int, UploadedFile>  $images
     */
    public function execute(
        Book $book,
        array $images
    ): void {

        if (empty($images)) {
            return;
        }

        $hasPrimaryImage = $book->images()
            ->where('is_primary', true)
            ->exists();

        $nextSortOrder = (int) $book->images()
            ->max('sort_order') + 1;

        foreach ($images as $index => $image) {

            $this->validateImage($image);

            $path = $image->store(
                'books',
                'public'
            );

            $book->images()->create([

                'image' => $path,

                'is_primary' => ! $hasPrimaryImage && $index === 0,

                'sort_order' => $nextSortOrder + $index,

            ]);

        }

    }

    /**
     * Valida uma imagem enviada.
     *
     * @throws InvalidBookImageException
     */
    private function validateImage(
        UploadedFile $image
    ): void {

        if (! $image->isValid()) {

            throw new InvalidBookImageException(
                'Imagem inválida.'
            );

        }

        if (! Str::startsWith(
            $image->getMimeType(),
            'image/'
        )) {

            throw new InvalidBookImageException(
                'O arquivo enviado não é uma imagem.'
            );

        }

    }
}
