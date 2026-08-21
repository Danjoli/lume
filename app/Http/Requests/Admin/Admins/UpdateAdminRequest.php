<?php

namespace App\Http\Requests\Admin\Admins;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateAdminRequest extends FormRequest
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

                Rule::unique('admins', 'email')
                    ->ignore($this->route('admin')),
            ],

            /*
            |--------------------------------------------------------------------------
            | Perfil
            |--------------------------------------------------------------------------
            */

            'role' => [
                'required',
                'string',
                'in:'.implode(',', array_keys(Admin::ROLES())),
            ],

            /*
            |--------------------------------------------------------------------------
            | Senha
            |--------------------------------------------------------------------------
            */

            'password' => [
                'nullable',
                'confirmed',
                Password::defaults(),
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
            'role' => 'perfil',
            'password' => 'senha',
        ];
    }
}
