<?php

namespace App\Data\Categories;

use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use Illuminate\Support\Str;

readonly class CategoryData
{
    public function __construct(
        public string $name,
        public ?string $description,
    ) {
    }

    /**
     * Cria um DTO a partir do Form Request.
     */
    public static function fromRequest(
        StoreCategoryRequest|UpdateCategoryRequest $request
    ): self {

        return new self(
            name: $request->string('name')->toString(),
            description: $request->filled('description')
                ? $request->string('description')->toString()
                : null,
        );
    }

    /**
     * Converte o DTO para array.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
        ];
    }
}
