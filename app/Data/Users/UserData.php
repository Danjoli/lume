<?php

namespace App\Data\Users;

use App\Enums\UserStatus;
use App\Http\Requests\Admin\Users\UpdateUserRequest;

readonly class UserData
{
    public function __construct(
        public string $name,
        public string $email,
        public UserStatus $status,
    ) {
    }

    /**
     * Cria um DTO a partir do Form Request.
     */
    public static function fromRequest(
        UpdateUserRequest $request
    ): self {

        return new self(
            name: $request->string('name')->toString(),
            email: $request->string('email')->toString(),
            status: UserStatus::from(
                $request->string('status')->toString()
            ),
        );

    }

    /**
     * Converte o DTO para array.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
        ];
    }
}
