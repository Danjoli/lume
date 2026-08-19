<?php

namespace App\Data\Authors;

use App\Http\Requests\Admin\Authors\StoreAuthorRequest;
use App\Http\Requests\Admin\Authors\UpdateAuthorRequest;
use Illuminate\Support\Str;

readonly class AuthorData
{
    public function __construct(
        public string $name,
        public ?string $biography,
    ) {
    }

    /**
     * Cria um DTO a partir do Form Request.
     */
    public static function fromRequest(
        StoreAuthorRequest|UpdateAuthorRequest $request
    ): self {

        return new self(
            name: $request->string('name')->toString(),
            biography: $request->filled('biography')
                ? $request->string('biography')->toString()
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
            'biography' => $this->biography,
        ];
    }
}
