<?php

namespace App\Services\Admin\Publishers;

use App\Actions\Publishers\CreatePublisherAction;
use App\Actions\Publishers\DeletePublisherAction;
use App\Actions\Publishers\UpdatePublisherAction;
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
        private readonly CreatePublisherAction $createPublisherAction,
        private readonly UpdatePublisherAction $updatePublisherAction,
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

        return $this->createPublisherAction
            ->execute($data);

    }

    /**
     * Atualiza uma editora.
     */
    public function update(
        Publisher $publisher,
        PublisherData $data
    ): Publisher {

        return $this->updatePublisherAction
            ->execute(
                $publisher,
                $data
            );

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
