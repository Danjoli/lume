<?php

namespace App\Http\Requests\Admin\Publishers;

use Illuminate\Foundation\Http\FormRequest;

class StorePublisherRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:publishers,name',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:publishers,email',
            ],

            'website' => [
                'nullable',
                'url',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

        ];
    }

    /**
     * Mensagens personalizadas.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome da editora é obrigatório.',
            'name.unique' => 'Já existe uma editora com este nome.',

            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está sendo utilizado.',

            'website.url' => 'Informe uma URL válida.',
        ];
    }
}
