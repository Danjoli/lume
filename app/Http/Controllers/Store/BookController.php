<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\Store\BookService;
use Illuminate\View\View;

class BookController extends Controller
{
    public function __construct(
        private readonly BookService $bookService
    ) {
    }

    /**
     * Exibe os detalhes de um livro.
     */
    public function show(
        Book $book
    ): View {
        return view(
            'store.books.show',
            $this->bookService->getBookData($book)
        );
    }
}
