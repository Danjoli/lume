<?php

namespace App\Http\Requests\Admin\Books;

class StoreBookRequest extends BookRequest
{
    /** @return array<int, string> */
    protected function isbnRules(): array
    {
        return ['required', 'string', 'max:255', 'unique:books,isbn'];
    }
}
