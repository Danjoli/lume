<?php

namespace App\Services\Admin\Authors;

use App\Actions\Authors\CreateAuthorAction;
use App\Actions\Authors\DeleteAuthorAction;
use App\Actions\Authors\UpdateAuthorAction;
use App\Data\Authors\AuthorData;
use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AuthorService
{
    /**
     * Quantidade de registros por página.
     */
    private const PER_PAGE = 10;

    public function __construct(
        private readonly CreateAuthorAction $createAuthorAction,
        private readonly UpdateAuthorAction $updateAuthorAction,
        private readonly DeleteAuthorAction $deleteAuthorAction,
    ) {
    }

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
    public function store(
        AuthorData $data
    ): Author {

        return $this->createAuthorAction
            ->execute($data);

    }

    /**
     * Atualiza um autor.
     */
    public function update(
        Author $author,
        AuthorData $data
    ): Author {

        return $this->updateAuthorAction
            ->execute(
                $author,
                $data
            );

    }

    /**
     * Remove um autor.
     */
    public function destroy(
        Author $author
    ): void {

        $this->deleteAuthorAction
            ->execute($author);

    }
}
