<?php

namespace App\Http\Controllers\Store\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use App\Services\Store\Catalog\PublisherService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublisherController extends Controller
{
    public function __construct(
        private readonly PublisherService $publisherService
    ) {}

    public function index(): View
    {
        return view(
            'store.publishers.index',
            [
                'publishers' => $this->publisherService->paginate(),
            ]
        );
    }

    public function show(
        Request $request,
        Publisher $publisher
    ): View {
        return view(
            'store.publishers.show',
            [
                'publisher' => $publisher,

                'books' => $this->publisherService->books(
                    $publisher,
                    $request
                ),
            ]
        );
    }
}
