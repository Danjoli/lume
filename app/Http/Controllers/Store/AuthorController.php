<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Services\Store\AuthorService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function __construct(
        private readonly AuthorService $authorService
    ) {
    }

    public function index(): View
    {
        return view('store.authors.index', [
            'authors' => $this->authorService->paginate(),
        ]);
    }

    public function show(
        Request $request,
        Author $author
    ): View {
        return view('store.authors.show', [
            'author' => $author,
            'books' => $this->authorService->books(
                $author,
                $request
            ),
        ]);
    }
}
