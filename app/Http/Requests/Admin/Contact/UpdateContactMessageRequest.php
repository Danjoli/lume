<?php

namespace App\Http\Requests\Admin\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'in_progress',
                    'answered',
                    'closed',
                ]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Selecione um status.',

            'status.in' => 'O status selecionado é inválido.',
        ];
    }
}
