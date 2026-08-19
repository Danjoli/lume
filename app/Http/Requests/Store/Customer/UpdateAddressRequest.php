<?php

namespace App\Http\Requests\Store\Customer;

class UpdateAddressRequest extends StoreAddressRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'label' => [
                'nullable',
                'string',
                'max:100',
            ],

            'recipient_name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

            'street' => [
                'required',
                'string',
                'max:255',
            ],

            'number' => [
                'required',
                'string',
                'max:20',
            ],

            'complement' => [
                'nullable',
                'string',
                'max:255',
            ],

            'neighborhood' => [
                'required',
                'string',
                'max:255',
            ],

            'city' => [
                'required',
                'string',
                'max:255',
            ],

            'state' => [
                'required',
                'string',
                'size:2',
            ],

            'cep' => [
                'required',
                'string',
                'max:9',
            ],

            'is_default' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
