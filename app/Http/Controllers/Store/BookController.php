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

    public function show(Book $book): View
    {
        return view('store.books.show', [
            'book' => $this->bookService->find($book),
            'relatedBooks' => $this->bookService->related($book),
        ]);
    }
}
