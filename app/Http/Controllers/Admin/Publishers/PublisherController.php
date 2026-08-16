<?php

namespace App\Http\Controllers\Admin\Publishers;

use App\Data\Publishers\PublisherData;
use App\Exceptions\Domain\CannotDeletePublisherException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Publishers\StorePublisherRequest;
use App\Http\Requests\Admin\Publishers\UpdatePublisherRequest;
use App\Models\Publisher;
use App\Services\Admin\Publishers\PublisherService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublisherController extends Controller
{
    public function __construct(
        private readonly PublisherService $publisherService
    ) {
    }

    /**
     * Exibe a listagem das editoras.
     */
    public function index(Request $request): View
    {
        return view('admin.publishers.index', [

            'publishers' => $this->publisherService->paginate($request),

        ]);
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create(): View
    {
        return view('admin.publishers.create');
    }

    /**
     * Armazena uma nova editora.
     */
    public function store(
        StorePublisherRequest $request
    ): RedirectResponse {

        $this->publisherService->store(

            PublisherData::fromRequest($request)

        );

        return redirect()

            ->route('admin.publishers.index')

            ->with(
                'success',
                'Editora cadastrada com sucesso.'
            );

    }

    /**
     * Exibe os detalhes da editora.
     */
    public function show(
        Publisher $publisher
    ): View {

        return view('admin.publishers.show', [

            'publisher' => $publisher->loadCount('books'),

        ]);

    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(
        Publisher $publisher
    ): View {

        return view('admin.publishers.edit', [

            'publisher' => $publisher,

        ]);

    }

    /**
     * Atualiza a editora.
     */
    public function update(
        UpdatePublisherRequest $request,
        Publisher $publisher
    ): RedirectResponse {

        $this->publisherService->update(

            $publisher,

            PublisherData::fromRequest($request)

        );

        return redirect()

            ->route('admin.publishers.index')

            ->with(
                'success',
                'Editora atualizada com sucesso.'
            );

    }

    /**
     * Remove uma editora.
     */
    public function destroy(
        Publisher $publisher
    ): RedirectResponse {

        try {

            $this->publisherService->destroy($publisher);

            return redirect()

                ->route('admin.publishers.index')

                ->with(
                    'success',
                    'Editora removida com sucesso.'
                );

        } catch (CannotDeletePublisherException $exception) {

            return redirect()

                ->route('admin.publishers.index')

                ->with(
                    'error',
                    $exception->getMessage()
                );

        }

    }
}
