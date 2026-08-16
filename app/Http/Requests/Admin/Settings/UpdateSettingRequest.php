<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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

            /*
            |--------------------------------------------------------------------------
            | Loja
            |--------------------------------------------------------------------------
            */

            'store_name' => [
                'required',
                'string',
                'max:255',
            ],

            'company_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'cnpj' => [
                'nullable',
                'string',
                'max:18',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Contato
            |--------------------------------------------------------------------------
            */

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:20',
            ],

            /*
            |--------------------------------------------------------------------------
            | Endereço
            |--------------------------------------------------------------------------
            */

            'cep' => [
                'nullable',
                'string',
                'max:10',
            ],

            'street' => [
                'nullable',
                'string',
                'max:255',
            ],

            'number' => [
                'nullable',
                'string',
                'max:20',
            ],

            'complement' => [
                'nullable',
                'string',
                'max:255',
            ],

            'neighborhood' => [
                'nullable',
                'string',
                'max:255',
            ],

            'city' => [
                'nullable',
                'string',
                'max:255',
            ],

            'state' => [
                'nullable',
                'string',
                'size:2',
            ],

            /*
            |--------------------------------------------------------------------------
            | Redes Sociais
            |--------------------------------------------------------------------------
            */

            'facebook' => [
                'nullable',
                'url',
                'max:255',
            ],

            'instagram' => [
                'nullable',
                'url',
                'max:255',
            ],

            'linkedin' => [
                'nullable',
                'url',
                'max:255',
            ],

            'youtube' => [
                'nullable',
                'url',
                'max:255',
            ],

            'tiktok' => [
                'nullable',
                'url',
                'max:255',
            ],

            'twitter' => [
                'nullable',
                'url',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Aparência
            |--------------------------------------------------------------------------
            */

            'logo' => [
                'nullable',
                'string',
                'max:255',
            ],

            'favicon' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
            ],

            'keywords' => [
                'nullable',
                'string',
                'max:500',
            ],

            /*
            |--------------------------------------------------------------------------
            | Pagamento
            |--------------------------------------------------------------------------
            */

            'payment_gateway' => [
                'nullable',
                'string',
                'max:100',
            ],

            'pix_key' => [
                'nullable',
                'string',
                'max:255',
            ],

            'currency' => [
                'required',
                'string',
                'max:10',
            ],

            /*
            |--------------------------------------------------------------------------
            | Frete
            |--------------------------------------------------------------------------
            */

            'default_carrier' => [
                'nullable',
                'string',
                'max:100',
            ],

            'origin_zipcode' => [
                'nullable',
                'string',
                'max:10',
            ],

            /*
            |--------------------------------------------------------------------------
            | Email
            |--------------------------------------------------------------------------
            */

            'sender_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sender_email' => [
                'nullable',
                'email',
                'max:255',
            ],

        ];
    }

    /**
     * Nome amigável dos campos.
     */
    public function attributes(): array
    {
        return [

            'store_name' => 'nome da loja',

            'company_name' => 'razão social',

            'cnpj' => 'CNPJ',

            'description' => 'descrição',

            'email' => 'e-mail',

            'phone' => 'telefone',

            'whatsapp' => 'WhatsApp',

            'cep' => 'CEP',

            'street' => 'rua',

            'number' => 'número',

            'complement' => 'complemento',

            'neighborhood' => 'bairro',

            'city' => 'cidade',

            'state' => 'estado',

            'facebook' => 'Facebook',

            'instagram' => 'Instagram',

            'linkedin' => 'LinkedIn',

            'youtube' => 'YouTube',

            'tiktok' => 'TikTok',

            'twitter' => 'X',

            'logo' => 'logo',

            'favicon' => 'favicon',

            'meta_title' => 'título SEO',

            'meta_description' => 'descrição SEO',

            'keywords' => 'palavras-chave',

            'payment_gateway' => 'gateway de pagamento',

            'pix_key' => 'chave Pix',

            'currency' => 'moeda',

            'default_carrier' => 'transportadora',

            'origin_zipcode' => 'CEP de origem',

            'sender_name' => 'nome do remetente',

            'sender_email' => 'e-mail do remetente',

        ];
    }
}
