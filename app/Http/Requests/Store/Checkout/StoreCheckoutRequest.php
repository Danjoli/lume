<?php

namespace App\Http\Requests\Store\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'address_id' => [
                'required',
                'integer',

                Rule::exists('addresses', 'id')
                    ->where(
                        'user_id',
                        $this->user()->id
                    ),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'address_id.required' =>
                'Selecione um endereço para entrega.',

            'address_id.exists' =>
                'O endereço selecionado é inválido.',
        ];
    }
}
