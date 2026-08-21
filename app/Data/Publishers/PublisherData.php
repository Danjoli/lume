<?php

namespace App\Data\Publishers;

use App\Http\Requests\Admin\Publishers\StorePublisherRequest;
use App\Http\Requests\Admin\Publishers\UpdatePublisherRequest;
use Illuminate\Support\Str;

readonly class PublisherData
{
    public function __construct(
        public string $name,
        public ?string $description,
        public ?string $website,
    ) {}

    /**
     * Cria um DTO a partir do Form Request.
     */
    public static function fromRequest(
        StorePublisherRequest|UpdatePublisherRequest $request
    ): self {

        return new self(
            name: $request->string('name')->toString(),

            description: $request->filled('description')
                ? $request->string('description')->toString()
                : null,

            website: $request->filled('website')
                ? $request->string('website')->toString()
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
            'website' => $this->website,
        ];
    }
}
