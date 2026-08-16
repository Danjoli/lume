<?php

namespace App\Http\Requests\Admin\Publishers;

use App\Models\Publisher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePublisherRequest extends FormRequest
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
        /** @var Publisher $publisher */
        $publisher = $this->route('publisher');

        return [

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('publishers', 'name')
                    ->ignore($publisher),
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('publishers', 'email')
                    ->ignore($publisher),
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
