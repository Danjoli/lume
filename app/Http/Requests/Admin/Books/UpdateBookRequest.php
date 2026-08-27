<?php

namespace App\Http\Requests\Admin\Books;

use Illuminate\Validation\Rule;

class UpdateBookRequest extends BookRequest
{
    /** @return array<int, mixed> */
    protected function isbnRules(): array
    {
        return [
            'required',
            'string',
            'max:255',
            Rule::unique('books', 'isbn')->ignore($this->route('book')),
        ];
    }
}
