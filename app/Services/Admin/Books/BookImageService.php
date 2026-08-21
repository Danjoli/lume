<?php

namespace App\Services\Admin\Books;

use App\Actions\Books\DeleteBookImagesAction;
use App\Actions\Books\SetPrimaryBookImageAction;
use App\Actions\Books\UploadBookImagesAction;
use App\Models\Book;

class BookImageService
{
    public function __construct(
        private readonly UploadBookImagesAction $uploadBookImagesAction,
        private readonly DeleteBookImagesAction $deleteBookImagesAction,
        private readonly SetPrimaryBookImageAction $setPrimaryBookImageAction,
    ) {}

    public function store(
        Book $book,
        array $images
    ): void {
        $this->uploadBookImagesAction
            ->execute($book, $images);
    }

    public function deleteAll(
        Book $book
    ): void {
        $this->deleteBookImagesAction
            ->execute($book);
    }

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
