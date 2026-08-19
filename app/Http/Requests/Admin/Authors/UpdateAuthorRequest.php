<?php

namespace App\Http\Requests\Admin\Authors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAuthorRequest extends FormRequest
{
    /**
     * Determina se o usuário pode realizar esta requisição.
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
                Rule::unique('authors', 'name')
                    ->ignore($this->route('author')),

            ],

            'biography' => [
                'nullable',
                'string',
            ],

        ];
    }

    /**
     * Nomes amigáveis dos campos.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'biography' => 'biografia',
        ];
    }

    /**
     * Mensagens personalizadas.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.unique' => 'Já existe um autor com este nome.',
            'name.max' => 'O nome deve possuir no máximo :max caracteres.',
        ];
    }
}
