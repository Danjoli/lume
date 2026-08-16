<?php

namespace App\Models;

use App\Enums\CouponType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [

        'code',

        'slug',

        'description',

        'type',

        'value',

        'minimum_amount',

        'usage_limit',

        'used_count',

        'starts_at',

        'expires_at',

        'is_active',

    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

            'type' => CouponType::class,

            'value' => 'decimal:2',

            'minimum_amount' => 'decimal:2',

            'starts_at' => 'datetime',

            'expires_at' => 'datetime',

            'is_active' => 'boolean',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isExpired(): bool
    {
        return $this->expires_at?->isPast() ?? false;
    }

    public function hasStarted(): bool
    {
        return $this->starts_at === null
            || $this->starts_at->isPast();
    }

    public function hasUsageLimit(): bool
    {
        return $this->usage_limit !== null;
    }

    public function remainingUses(): ?int
    {
        if (! $this->hasUsageLimit()) {

            return null;

        }

        return max(
            0,
            $this->usage_limit - $this->used_count
        );
    }

    public function canBeUsed(): bool
    {
        if (! $this->is_active) {

            return false;

        }

        if (! $this->hasStarted()) {

            return false;

        }

        if ($this->isExpired()) {

            return false;

        }

        if (
            $this->hasUsageLimit()
            && $this->used_count >= $this->usage_limit
        ) {

            return false;

        }

        return true;
    }
}
