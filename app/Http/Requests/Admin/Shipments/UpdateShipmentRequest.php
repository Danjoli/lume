<?php

namespace App\Http\Requests\Admin\Shipments;

use App\Enums\ShipmentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShipmentRequest extends FormRequest
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
            /*
            |--------------------------------------------------------------------------
            | Transportadora
            |--------------------------------------------------------------------------
            */

            'carrier' => [
                'required',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Código de rastreio
            |--------------------------------------------------------------------------
            */

            'tracking_code' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Serviço
            |--------------------------------------------------------------------------
            */

            'service' => [
                'required',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                Rule::enum(ShipmentStatus::class),
            ],

            /*
            |--------------------------------------------------------------------------
            | Frete
            |--------------------------------------------------------------------------
            */

            'shipping_cost' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }

    /**
     * Nome amigável dos atributos.
     */
    public function attributes(): array
    {
        return [
            'carrier' => 'transportadora',
            'tracking_code' => 'código de rastreio',
            'service' => 'serviço',
            'status' => 'status',
            'shipping_cost' => 'valor do frete',
        ];
    }
}
