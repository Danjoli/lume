<?php

namespace App\Services\Admin\Books;

use App\Data\Books\BookData;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class BookService
{
    private const PER_PAGE = 10;

    public function __construct(
        private readonly BookImageService $bookImageService,
    ) {
    }

    public function getIndexData(Request $request): array
    {
        return array_merge(
            [
                'books' => $this->paginate($request),
            ],
            $this->getRelations()
        );
    }

    public function getFormData(): array
    {
        return $this->getRelations();
    }

    public function paginate(
        Request $request
    ): LengthAwarePaginator {
        return Book::query()
            ->with([
                'publisher',
                'authors',
                'categories',
            ])
            ->when(
                $request->filled('search'),
                fn ($query) => $query->where(
                    'title',
                    'like',
                    '%' . $request->string('search') . '%'
                )
            )
            ->latest()
            ->paginate(self::PER_PAGE)
            ->withQueryString();
    }

    public function store(
        BookData $data
    ): Book {
        $book = Book::create(
            $data->toArray()
        );

        $book->authors()->sync(
            $data->authors
        );

        $book->categories()->sync(
            $data->categories
        );

        if (! empty($data->images)) {
            $this->bookImageService->store(
                $book,
                $data->images
            );
        }

        return $book->refresh();
    }

    public function update(
        Book $book,
        BookData $data
    ): Book {
        $book->update(
            $data->toArray()
        );

        $book->authors()->sync(
            $data->authors
        );

        $book->categories()->sync(
            $data->categories
        );

        if (! empty($data->images)) {
            $this->bookImageService->store(
                $book,
                $data->images
            );
        }

        return $book->refresh();
    }

    public function destroy(
        Book $book
    ): void {
        $this->bookImageService
            ->deleteAll($book);

        $book->delete();
    }

    private function getRelations(): array
    {
        return [
            'authors' => Author::query()
                ->orderBy('name')
                ->get(),

            'categories' => Category::query()
                ->orderBy('name')
                ->get(),

            'publishers' => Publisher::query()
                ->orderBy('name')
                ->get(),
        ];
    }
}
