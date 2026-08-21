<?php

namespace App\Http\Requests\Store\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return ['rating' => ['required', 'integer', 'between:1,5'], 'comment' => ['required', 'string', 'min:10', 'max:2000']];
    }

    public function messages(): array
    {
        return ['rating.between' => 'Escolha uma nota entre 1 e 5.', 'comment.min' => 'Conte um pouco mais sobre sua experiência (mínimo de 10 caracteres).'];
    }
}
