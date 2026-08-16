<?php

namespace App\Services\Admin\Books;

use App\Actions\Books\CreateBookAction;
use App\Actions\Books\DeleteBookAction;
use App\Actions\Books\SyncAuthorsAction;
use App\Actions\Books\SyncCategoriesAction;
use App\Actions\Books\UpdateBookAction;
use App\Data\Books\BookData;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class BookService
{
    private const PER_PAGE = 10;

    public function __construct(
        private readonly CreateBookAction $createBookAction,
        private readonly UpdateBookAction $updateBookAction,
        private readonly DeleteBookAction $deleteBookAction,
        private readonly SyncAuthorsAction $syncAuthorsAction,
        private readonly SyncCategoriesAction $syncCategoriesAction,
        private readonly BookImageService $bookImageService,
    ) {
    }

    /**
     * Dados da tela de listagem.
     */
    public function getIndexData(Request $request): array
    {
        return array_merge(
            [
                'books' => $this->paginate($request),
            ],
            $this->getRelations()
        );
    }

    /**
     * Dados utilizados no formulário.
     */
    public function getFormData(): array
    {
        return $this->getRelations();
    }

    /**
     * Lista paginada dos livros.
     */
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

    /**
     * Cadastra um livro.
     */
    public function store(
        BookData $data
    ): Book {

        $book = $this->createBookAction
            ->execute($data);

        $this->syncAuthorsAction
            ->execute(
                $book,
                $data->authors
            );

        $this->syncCategoriesAction
            ->execute(
                $book,
                $data->categories
            );

        if (! empty($data->images)) {

            $this->bookImageService
                ->store(
                    $book,
                    $data->images
                );

        }

        return $book->refresh();

    }

    /**
     * Atualiza um livro.
     */
    public function update(
        Book $book,
        BookData $data
    ): Book {

        $book = $this->updateBookAction
            ->execute(
                $book,
                $data
            );

        $this->syncAuthorsAction
            ->execute(
                $book,
                $data->authors
            );

        $this->syncCategoriesAction
            ->execute(
                $book,
                $data->categories
            );

        if (! empty($data->images)) {

            $this->bookImageService
                ->store(
                    $book,
                    $data->images
                );

        }

        return $book;

    }

    /**
     * Remove um livro.
     */
    public function destroy(
        Book $book
    ): void {

        $this->bookImageService
            ->deleteAll($book);

        $this->deleteBookAction
            ->execute($book);

    }

    /**
     * Relacionamentos utilizados nos formulários.
     */
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
