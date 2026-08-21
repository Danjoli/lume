<?php

namespace App\Http\Controllers\Store\Content;

use App\Http\Controllers\Controller;
use App\Services\Store\Content\HomeService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly HomeService $homeService
    ) {}

    public function index(): View
    {
        return view(
            'store.home',
            $this->homeService->getHomeData()
        );
    }
}
