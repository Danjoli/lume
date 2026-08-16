<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Data\Categories\CategoryData;
use App\Exceptions\Domain\CannotDeleteCategoryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Admin\Categories\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService
    ) {
    }

    /**
     * Exibe a listagem das categorias.
     */
    public function index(Request $request): View
    {
        return view('admin.categories.index', [

            'categories' => $this->categoryService->paginate($request),

        ]);
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Armazena uma nova categoria.
     */
    public function store(
        StoreCategoryRequest $request
    ): RedirectResponse {

        $this->categoryService->store(

            CategoryData::fromRequest($request)

        );

        return redirect()

            ->route('admin.categories.index')

            ->with(
                'success',
                'Categoria cadastrada com sucesso.'
            );

    }

    /**
     * Exibe os detalhes da categoria.
     */
    public function show(
        Category $category
    ): View {

        return view('admin.categories.show', [

            'category' => $category->loadCount('books'),

        ]);

    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(
        Category $category
    ): View {

        return view('admin.categories.edit', [

            'category' => $category,

        ]);

    }

    /**
     * Atualiza a categoria.
     */
    public function update(
        UpdateCategoryRequest $request,
        Category $category
    ): RedirectResponse {

        $this->categoryService->update(

            $category,

            CategoryData::fromRequest($request)

        );

        return redirect()

            ->route('admin.categories.index')

            ->with(
                'success',
                'Categoria atualizada com sucesso.'
            );

    }

    /**
     * Remove uma categoria.
     */
    public function destroy(
        Category $category
    ): RedirectResponse {

        try {

            $this->categoryService->destroy($category);

            return redirect()

                ->route('admin.categories.index')

                ->with(
                    'success',
                    'Categoria removida com sucesso.'
                );

        } catch (CannotDeleteCategoryException $exception) {

            return redirect()

                ->route('admin.categories.index')

                ->with(
                    'error',
                    $exception->getMessage()
                );

        }

    }
}
