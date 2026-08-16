<?php

namespace App\Actions\Categories;

use App\Data\Categories\CategoryData;
use App\Models\Category;

class CreateCategoryAction
{
    /**
     * Cria uma nova categoria.
     */
    public function execute(
        CategoryData $data
    ): Category {

        return Category::create(
            $data->toArray()
        );

    }
}
