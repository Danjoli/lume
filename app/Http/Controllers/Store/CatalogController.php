<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Services\Store\CatalogService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService
    ) {
    }

    public function index(Request $request): View
    {
        return view(
            'store.catalog.index',
            $this->catalogService->getCatalogData($request)
        );
    }
}
