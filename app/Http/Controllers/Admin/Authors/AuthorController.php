<?php

namespace App\Http\Controllers\Admin\Authors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Authors\StoreAuthorRequest;
use App\Http\Requests\Admin\Authors\UpdateAuthorRequest;
use App\Models\Author;

use App\Services\Admin\Authors\AuthorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function __construct(
        private readonly AuthorService $authorService
    ) {
    }

    /**
     * Exibe a listagem dos autores.
     */
    public function index(Request $request): View
    {
        return view('admin.authors.index', [
            'authors' => $this->authorService->paginate($request),
        ]);
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create(): View
    {
        return view('admin.authors.create');
    }

    /**
     * Armazena um novo autor.
     */
    public function store(StoreAuthorRequest $request): RedirectResponse
    {
        $this->authorService->store(
            $request->validated()
        );

        return redirect()
            ->route('admin.authors.index')
            ->with('success', 'Autor cadastrado com sucesso.');
    }

    /**
     * Exibe os detalhes do autor.
     */
    public function show(Author $author): View
    {
        return view('admin.authors.show', [
            'author' => $author->loadCount('books'),
        ]);
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Author $author): View
    {
        return view('admin.authors.edit', [
            'author' => $author,
        ]);
    }

    /**
     * Atualiza o autor.
     */
    public function update(
        UpdateAuthorRequest $request,
        Author $author
    ): RedirectResponse {
        $this->authorService->update(
            $author,
            $request->validated()
        );

        return redirect()
            ->route('admin.authors.index')
            ->with('success', 'Autor atualizado com sucesso.');
    }

    /**
     * Remove um autor.
     */
    public function destroy(Author $author): RedirectResponse
    {
        $this->authorService->destroy($author);

        return redirect()
            ->route('admin.authors.index')
            ->with('success', 'Autor removido com sucesso.');
    }
}
