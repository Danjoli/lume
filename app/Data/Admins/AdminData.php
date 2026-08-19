<?php

namespace App\Data\Admins;

use App\Http\Requests\Admin\Admins\StoreAdminRequest;
use App\Http\Requests\Admin\Admins\UpdateAdminRequest;
use Illuminate\Support\Facades\Hash;

readonly class AdminData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $role,
        public ?string $password,
    ) {
    }

    /**
     * Cria um DTO a partir do Form Request.
     */
    public static function fromRequest(
        StoreAdminRequest|UpdateAdminRequest $request
    ): self {

        return new self(
            name: $request->string('name')->toString(),
            email: $request->string('email')->toString(),
            role: $request->string('role')->toString(),
            password: $request->filled('password')
                ? $request->string('password')->toString()
                : null,
        );
    }

    /**
     * Converte o DTO para array.
     */
    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if ($this->password !== null) {

            $data['password'] = Hash::make(
                $this->password
            );

        }

        return $data;
    }
}
