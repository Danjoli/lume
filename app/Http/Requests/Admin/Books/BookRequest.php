<?php

namespace App\Http\Requests\Admin\Books;

use Illuminate\Foundation\Http\FormRequest;

abstract class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<int, mixed> */
    abstract protected function isbnRules(): array;

    /** @return array<string, array<int, mixed>> */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'isbn' => $this->isbnRules(),
            'description' => ['nullable', 'string'],
            'synopsis' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0', 'lte:price'],
            'stock' => ['required', 'integer', 'min:0'],
            'pages' => ['nullable', 'integer', 'min:1'],
            'language' => ['required', 'string', 'max:100'],
            'edition' => ['nullable', 'string', 'max:100'],
            'format' => ['required', 'string', 'max:100'],
            'publication_date' => ['nullable', 'date'],
            'weight' => ['required', 'numeric', 'min:0'],
            'height' => ['nullable', 'numeric', 'min:0'],
            'width' => ['nullable', 'numeric', 'min:0'],
            'length' => ['nullable', 'numeric', 'min:0'],
            'publisher_id' => ['nullable', 'exists:publishers,id'],
            'authors' => ['required', 'array', 'min:1'],
            'authors.*' => ['exists:authors,id'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['exists:categories,id'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];
    }

    /** @return array<string, string> */
    public function attributes(): array
    {
        return [
            'title' => 'título',
            'isbn' => 'ISBN',
            'description' => 'descrição',
            'synopsis' => 'sinopse',
            'price' => 'preço',
            'sale_price' => 'preço promocional',
            'stock' => 'estoque',
            'pages' => 'páginas',
            'language' => 'idioma',
            'edition' => 'edição',
            'format' => 'formato',
            'publication_date' => 'data de publicação',
            'weight' => 'peso',
            'height' => 'altura',
            'width' => 'largura',
            'length' => 'comprimento',
            'publisher_id' => 'editora',
            'authors' => 'autores',
            'categories' => 'categorias',
            'images' => 'imagens',
        ];
    }
}
