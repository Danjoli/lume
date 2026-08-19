<?php

namespace App\Http\Requests\Store\Cart;

use Illuminate\Foundation\Http\FormRequest;

class ToggleCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_id' => [
                'required',
                'integer',
                'exists:books,id',
            ],
        ];
    }
}
