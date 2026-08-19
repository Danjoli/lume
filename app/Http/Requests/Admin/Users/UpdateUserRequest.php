<?php

namespace App\Http\Requests\Admin\Users;

use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            | Informações básicas
            |--------------------------------------------------------------------------
            */

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',

                Rule::unique('users', 'email')
                    ->ignore($this->route('user')),
            ],

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',

                Rule::enum(UserStatus::class),
            ],

        ];
    }

    /**
     * Nome amigável dos atributos.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'email' => 'e-mail',
            'status' => 'status',
        ];
    }
}
