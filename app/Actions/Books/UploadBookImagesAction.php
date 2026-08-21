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

        foreach ($images as $index => $image) {

            $this->validateImage($image);

            $path = $image->store(
                'books',
                'public'
            );

            $book->images()->create([

                'path' => $path,

                'is_primary' => $index === 0,

                'sort_order' => $index + 1,

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
