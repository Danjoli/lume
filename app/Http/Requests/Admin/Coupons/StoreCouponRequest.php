<?php

namespace App\Http\Requests\Admin\Coupons;

use App\Enums\CouponType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCouponRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [

            'code' => [
                'required',
                'string',
                'max:100',
                'unique:coupons,code',
            ],

            'description' => [
                'nullable',
                'string',
                'max:255',
            ],

            'type' => [
                'required',
                Rule::enum(CouponType::class),
            ],

            'value' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'minimum_amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'usage_limit' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'starts_at' => [
                'nullable',
                'date',
            ],

            'expires_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

        ];
    }

    /**
     * Nome amigável dos campos.
     */
    public function attributes(): array
    {
        return [

            'code' => 'código',

            'description' => 'descrição',

            'type' => 'tipo',

            'value' => 'valor',

            'minimum_amount' => 'valor mínimo',

            'usage_limit' => 'limite de uso',

            'starts_at' => 'data inicial',

            'expires_at' => 'data final',

            'is_active' => 'status',

        ];
    }
}
