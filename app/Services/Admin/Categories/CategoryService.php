<?php

namespace App\Services\Admin\Categories;

use App\Actions\Categories\CreateCategoryAction;
use App\Actions\Categories\DeleteCategoryAction;
use App\Actions\Categories\UpdateCategoryAction;
use App\Data\Categories\CategoryData;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class CategoryService
{
    /**
     * Quantidade de registros por página.
     */
    private const PER_PAGE = 10;

    public function __construct(
        private readonly CreateCategoryAction $createCategoryAction,
        private readonly UpdateCategoryAction $updateCategoryAction,
        private readonly DeleteCategoryAction $deleteCategoryAction,
    ) {
    }

    /**
     * Lista paginada das categorias.
     */
    public function paginate(
        Request $request
    ): LengthAwarePaginator {

        return Category::query()

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
     * Cadastra uma categoria.
     */
    public function store(
        CategoryData $data
    ): Category {

        return $this->createCategoryAction
            ->execute($data);

    }

    /**
     * Atualiza uma categoria.
     */
    public function update(
        Category $category,
        CategoryData $data
    ): Category {

        return $this->updateCategoryAction
            ->execute(
                $category,
                $data
            );

    }

    /**
     * Remove uma categoria.
     */
    public function destroy(
        Category $category
    ): void {

        $this->deleteCategoryAction
            ->execute($category);

    }
}
