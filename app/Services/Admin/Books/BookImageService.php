<?php

namespace App\Services\Admin\Books;

use App\Actions\Books\Images\DeleteBookImagesAction;
use App\Actions\Books\Images\SetPrimaryBookImageAction;
use App\Actions\Books\Images\UploadBookImagesAction;
use App\Models\Book;
use Illuminate\Http\UploadedFile;

class BookImageService
{
    public function __construct(
        private readonly UploadBookImagesAction $uploadBookImagesAction,
        private readonly DeleteBookImagesAction $deleteBookImagesAction,
        private readonly SetPrimaryBookImageAction $setPrimaryBookImageAction,
    ) {
    }

    /**
     * Salva as imagens do livro.
     *
     * @param array<int, UploadedFile> $images
     */
    public function store(
        Book $book,
        array $images
    ): void {

        $this->uploadBookImagesAction
            ->execute(
                $book,
                $images
            );

    }

    /**
     * Remove todas as imagens do livro.
     */
    public function deleteAll(
        Book $book
    ): void {

        $this->deleteBookImagesAction
            ->execute($book);

    }

    /**
     * Define uma imagem como principal.
     */
    public function setPrimary(
        Book $book,
        int $imageId
    ): void {

        $this->setPrimaryBookImageAction
            ->execute(
                $book,
                $imageId
            );

    }
}
