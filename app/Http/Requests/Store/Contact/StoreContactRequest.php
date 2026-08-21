<?php

namespace App\Http\Requests\Store\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:120',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'subject' => [
                'required',
                Rule::in([
                    'order',
                    'shipping',
                    'payment',
                    'exchange',
                    'product',
                    'account',
                    'other',
                ]),
            ],

            'message' => [
                'required',
                'string',
                'min:10',
                'max:5000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Informe seu nome.',
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'subject.required' => 'Selecione um assunto.',
            'subject.in' => 'O assunto selecionado é inválido.',
            'message.required' => 'Escreva sua mensagem.',
            'message.min' => 'A mensagem deve possuir pelo menos 10 caracteres.',
        ];
    }
}
