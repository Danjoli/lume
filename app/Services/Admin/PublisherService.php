<?php

namespace App\Services\Admin;

use App\Actions\Publishers\DeletePublisherAction;
use App\Data\Publishers\PublisherData;
use App\Models\Publisher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class PublisherService
{
    /**
     * Quantidade de registros por página.
     */
    private const PER_PAGE = 10;

    public function __construct(
        private readonly DeletePublisherAction $deletePublisherAction,
    ) {
    }

    /**
     * Lista paginada das editoras.
     */
    public function paginate(
        Request $request
    ): LengthAwarePaginator {
        return Publisher::query()
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
     * Cadastra uma editora.
     */
    public function store(
        PublisherData $data
    ): Publisher {
        return Publisher::create(
            $data->toArray()
        );
    }

    /**
     * Atualiza uma editora.
     */
    public function update(
        Publisher $publisher,
        PublisherData $data
    ): Publisher {
        $publisher->update(
            $data->toArray()
        );

        return $publisher->refresh();
    }

    /**
     * Remove uma editora.
     */
    public function destroy(
        Publisher $publisher
    ): void {
        $this->deletePublisherAction
            ->execute($publisher);
    }
}
