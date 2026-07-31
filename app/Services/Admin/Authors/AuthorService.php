<?php

namespace App\Services\Admin\Authors;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AuthorService
{
    /**
     * Quantidade de registros por página.
     */
    private const PER_PAGE = 10;

    /**
     * Retorna os autores paginados.
     */
    public function paginate(Request $request): LengthAwarePaginator
    {
        return Author::query()

            ->withCount('books')

            ->when(
                $request->filled('search'),
                fn ($query) => $query->where(
                    'name',
                    'like',
                    '%' . $request->string('search') . '%'
                )
            )

            ->orderBy(
                $request->input('sort', 'name'),
                $request->input('direction', 'asc')
            )

            ->paginate(self::PER_PAGE)

            ->withQueryString();
    }

    /**
     * Cria um novo autor.
     */
    public function store(array $data): Author
    {
        return Author::create($data);
    }

    /**
     * Atualiza um autor.
     */
    public function update(
        Author $author,
        array $data
    ): Author {

        $author->update($data);

        return $author->refresh();
    }

    /**
     * Remove um autor.
     */
    public function destroy(Author $author): void
    {
        if ($author->books()->exists()) {

            abort(
                422,
                'Este autor possui livros cadastrados e não pode ser removido.'
            );

        }

        $author->delete();
    }
}
