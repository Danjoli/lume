<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Store\CategoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService
    ) {
    }

    public function index(): View
    {
        return view('store.categories.index', [
            'categories' => $this->categoryService->all(),
        ]);
    }

    public function show(
        Request $request,
        Category $category
    ): View {
        return view('store.categories.show', [
            'category' => $category,
            'books' => $this->categoryService->books(
                $category,
                $request
            ),
        ]);
    }
}
