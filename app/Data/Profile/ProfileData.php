<?php

namespace App\Data\Profile;

use App\Http\Requests\Admin\Profile\UpdateProfileRequest;

readonly class ProfileData
{
    public function __construct(
        public string $name,
        public string $email,
    ) {
    }

    /**
     * Cria um DTO a partir da Request.
     */
    public static function fromRequest(
        UpdateProfileRequest $request
    ): self {

        return new self(

            name: $request->string('name')->toString(),

            email: $request->string('email')->toString(),

        );

    }

    /**
     * Converte para array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [

            'name' => $this->name,

            'email' => $this->email,

        ];
    }
}
