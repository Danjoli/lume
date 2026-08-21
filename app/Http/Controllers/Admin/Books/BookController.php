<?php

namespace App\Http\Controllers\Admin\Books;

use App\Data\Books\BookData;
use App\Exceptions\Domain\CannotDeleteBookException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Books\StoreBookRequest;
use App\Http\Requests\Admin\Books\UpdateBookRequest;
use App\Models\Book;
use App\Services\Admin\Books\BookService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function __construct(
        private readonly BookService $bookService
    ) {}

    /**
     * Exibe a listagem dos livros.
     */
    public function index(Request $request): View
    {
        return view(
            'admin.books.index',
            $this->bookService->getIndexData($request)
        );
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create(): View
    {
        return view(
            'admin.books.create',
            $this->bookService->getFormData()
        );
    }

    /**
     * Armazena um novo livro.
     */
    public function store(
        StoreBookRequest $request
    ): RedirectResponse {

        $this->bookService->store(

            BookData::fromRequest($request)

        );

        return redirect()

            ->route('admin.books.index')

            ->with(
                'success',
                'Livro cadastrado com sucesso.'
            );

    }

    /**
     * Exibe os detalhes do livro.
     */
    public function show(
        Book $book
    ): View {

        return view('admin.books.show', [

            'book' => $book->load([
                'publisher',
                'authors',
                'categories',
                'images',
            ]),

        ]);

    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Book $book): View
    {
        return view(
            'admin.books.edit',
            array_merge(
                $this->bookService->getFormData(),
                [
                    'book' => $book->load([
                        'publisher',
                        'authors',
                        'categories',
                        'images',
                    ]),
                ]
            )
        );
    }

    /**
     * Atualiza um livro.
     */
    public function update(
        UpdateBookRequest $request,
        Book $book
    ): RedirectResponse {

        $this->bookService->update(

            $book,

            BookData::fromRequest($request)

        );

        return redirect()

            ->route('admin.books.index')

            ->with(
                'success',
                'Livro atualizado com sucesso.'
            );

    }

    /**
     * Remove um livro.
     */
    public function destroy(
        Book $book
    ): RedirectResponse {

        try {

            $this->bookService->destroy($book);

            return redirect()

                ->route('admin.books.index')

                ->with(
                    'success',
                    'Livro removido com sucesso.'
                );

        } catch (CannotDeleteBookException $exception) {

            return redirect()

                ->route('admin.books.index')

                ->with(
                    'error',
                    $exception->getMessage()
                );

        }

    }
}
