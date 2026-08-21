<?php

namespace App\Http\Requests\Admin\Newsletter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsletterCampaignRequest extends FormRequest
{
    /**
     * Determina se o administrador pode realizar a requisição.
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

    /**
     * Mensagens de validação.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'subject.required' => 'Informe o assunto do e-mail.',

            'subject.string' => 'O assunto deve ser um texto.',

            'subject.max' => 'O assunto pode ter no máximo 255 caracteres.',

            'title.required' => 'Informe o título da campanha.',

            'title.string' => 'O título deve ser um texto.',

            'title.max' => 'O título pode ter no máximo 255 caracteres.',

            'content.required' => 'Informe o conteúdo da campanha.',

            'content.string' => 'O conteúdo deve ser um texto.',

            'content.min' => 'O conteúdo deve possuir pelo menos 10 caracteres.',
        ];
    }
}
