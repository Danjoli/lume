<?php

namespace App\Actions\Categories;

use App\Exceptions\Domain\CannotDeleteCategoryException;
use App\Models\Category;

class DeleteCategoryAction
{
    /**
     * Remove uma categoria.
     */
    public function execute(
        Category $category
    ): void {

        if ($category->books()->exists()) {

            throw new CannotDeleteCategoryException();

        }

        $category->delete();

    }
}
