<?php

namespace App\Actions\Categories;

use App\Data\Categories\CategoryData;
use App\Models\Category;

class UpdateCategoryAction
{
    /**
     * Atualiza uma categoria.
     */
    public function execute(
        Category $category,
        CategoryData $data
    ): Category {

        $category->update(
            $data->toArray()
        );

        return $category->refresh();

    }
}
