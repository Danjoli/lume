<?php

namespace App\Data\Coupons;

use App\Enums\CouponType;
use App\Http\Requests\Admin\Coupons\StoreCouponRequest;
use App\Http\Requests\Admin\Coupons\UpdateCouponRequest;
use Illuminate\Support\Str;

readonly class CouponData
{
    public function __construct(
        public string $code,
        public ?string $description,
        public CouponType $type,
        public float $value,
        public float $minimumAmount,
        public ?int $usageLimit,
        public ?string $startsAt,
        public ?string $expiresAt,
        public bool $isActive,
    ) {}

    /**
     * Cria um DTO a partir do Form Request.
     */
    public static function fromRequest(
        StoreCouponRequest|UpdateCouponRequest $request
    ): self {

        return new self(

            code: strtoupper(
                $request->string('code')->toString()
            ),

            description: $request->filled('description')
                ? $request->string('description')->toString()
                : null,

            type: CouponType::from(
                $request->string('type')->toString()
            ),

            value: (float) $request->input('value'),

            minimumAmount: (float) $request->input(
                'minimum_amount',
                0
            ),

            usageLimit: $request->filled('usage_limit')
                ? (int) $request->input('usage_limit')
                : null,

            startsAt: $request->filled('starts_at')
                ? $request->input('starts_at')
                : null,

            expiresAt: $request->filled('expires_at')
                ? $request->input('expires_at')
                : null,

            isActive: $request->boolean('is_active'),

        );

    }

    /**
     * Converte o DTO para array.
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'slug' => Str::slug($this->code),
            'description' => $this->description,
            'type' => $this->type,
            'value' => $this->value,
            'minimum_amount' => $this->minimumAmount,
            'usage_limit' => $this->usageLimit,
            'starts_at' => $this->startsAt,
            'expires_at' => $this->expiresAt,
            'is_active' => $this->isActive,
        ];
    }
}
