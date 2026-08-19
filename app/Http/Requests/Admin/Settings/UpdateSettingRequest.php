<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
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
                'max:2000',
            ],

            'email' => [
                'nullable',
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

            'cep' => [
                'nullable',
                'string',
                'max:9',
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

            'instagram' => ['nullable', 'url', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],

            'logo' => [
                'nullable',
                'image',
                'max:2048',
            ],

            'favicon' => [
                'nullable',
                'image',
                'max:1024',
            ],

            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'minimum_order_amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'allow_out_of_stock_sales' => [
                'nullable',
                'boolean',
            ],

            'currency' => [
                'required',
                Rule::in([
                    'BRL',
                ]),
            ],

            'origin_cep' => [
                'nullable',
                'string',
                'max:9',
            ],

            'free_shipping_threshold' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'low_stock_threshold' => [
                'required',
                'integer',
                'min:0',
            ],

            'reviews_require_purchase' => [
                'nullable',
                'boolean',
            ],

            'reviews_auto_approve' => [
                'nullable',
                'boolean',
            ],

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
}
