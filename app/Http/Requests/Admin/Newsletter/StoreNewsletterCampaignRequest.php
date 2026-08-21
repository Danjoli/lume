<?php

namespace App\Http\Requests\Admin\Newsletter;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsletterCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject' => [
                'required',
                'string',
                'max:255',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'required',
                'string',
                'min:10',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => 'Informe o assunto do e-mail.',

            'title.required' => 'Informe o título da campanha.',

            'content.required' => 'Informe o conteúdo da campanha.',

            'content.min' => 'O conteúdo deve possuir pelo menos 10 caracteres.',
        ];
    }
}
