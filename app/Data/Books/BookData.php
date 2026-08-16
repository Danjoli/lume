<?php

namespace App\Data\Books;

use App\Http\Requests\Admin\Books\StoreBookRequest;
use App\Http\Requests\Admin\Books\UpdateBookRequest;
use Illuminate\Support\Str;

readonly class BookData
{
    public function __construct(
        public string $title,
        public string $isbn,
        public ?string $description,
        public ?string $synopsis,
        public ?float $price,
        public ?float $salePrice,
        public int $stock,
        public ?int $pages,
        public string $language,
        public ?string $edition,
        public string $format,
        public ?string $publicationDate,
        public float $weight,
        public ?float $height,
        public ?float $width,
        public ?float $length,
        public ?int $publisherId,
        public bool $isFeatured,
        public bool $isActive,
        public array $authors,
        public array $categories,
        public array $images,
    ) {
    }

    public static function fromRequest(
        StoreBookRequest|UpdateBookRequest $request
    ): self {

        return new self(

            title: $request->string('title')->toString(),

            isbn: $request->string('isbn')->toString(),

            description: $request->input('description'),

            synopsis: $request->input('synopsis'),

            price: $request->filled('price')
                ? (float) $request->input('price')
                : null,

            salePrice: $request->filled('sale_price')
                ? (float) $request->input('sale_price')
                : null,

            stock: (int) $request->input('stock', 0),

            pages: $request->filled('pages')
                ? (int) $request->input('pages')
                : null,

            language: $request->input('language', 'Português'),

            edition: $request->input('edition'),

            format: $request->input('format', 'Capa comum'),

            publicationDate: $request->input('publication_date'),

            weight: (float) $request->input('weight', 0),

            height: $request->filled('height')
                ? (float) $request->input('height')
                : null,

            width: $request->filled('width')
                ? (float) $request->input('width')
                : null,

            length: $request->filled('length')
                ? (float) $request->input('length')
                : null,

            publisherId: $request->filled('publisher_id')
                ? (int) $request->input('publisher_id')
                : null,

            isFeatured: $request->boolean('is_featured'),

            isActive: $request->boolean('is_active', true),

            authors: $request->input('authors', []),

            categories: $request->input('categories', []),

            images: $request->file('images', []),

        );
    }

    public function toArray(): array
    {
        return [

            'title' => $this->title,

            'slug' => Str::slug($this->title),

            'isbn' => $this->isbn,

            'description' => $this->description,

            'synopsis' => $this->synopsis,

            'price' => $this->price,

            'sale_price' => $this->salePrice,

            'stock' => $this->stock,

            'pages' => $this->pages,

            'language' => $this->language,

            'edition' => $this->edition,

            'format' => $this->format,

            'publication_date' => $this->publicationDate,

            'weight' => $this->weight,

            'height' => $this->height,

            'width' => $this->width,

            'length' => $this->length,

            'publisher_id' => $this->publisherId,

            'is_featured' => $this->isFeatured,

            'is_active' => $this->isActive,

        ];
    }
}
