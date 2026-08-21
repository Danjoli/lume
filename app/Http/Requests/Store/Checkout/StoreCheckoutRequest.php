<?php

namespace App\Http\Requests\Store\Checkout;

use App\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
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

            'cpf' => [
                'required',
                'string',
                'max:14',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

            'shipping_service' => [
                'required',
                'string',
            ],

            'payment_method' => [
                'required',
                new Enum(PaymentMethod::class),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'address_id.required' => 'Selecione um endereço para entrega.',

            'address_id.exists' => 'O endereço selecionado é inválido.',

            'cpf.required' => 'Informe seu CPF.',

            'phone.required' => 'Informe seu telefone.',

            'shipping_service.required' => 'Selecione uma forma de entrega.',

            'payment_method.required' => 'Selecione uma forma de pagamento.',

            'payment_method.enum' => 'A forma de pagamento selecionada é inválida.',
        ];
    }
}
