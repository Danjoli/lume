<?php

namespace App\Models;

use App\Enums\ShipmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    use HasFactory;

    /**
     * Campos preenchíveis.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_id',

        'carrier',
        'tracking_code',
        'service',

        'status',

        'shipping_cost',

        'shipped_at',
        'delivered_at',
    ];

    /**
     * Conversões de atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

            'status' => ShipmentStatus::class,

            'shipping_cost' => 'decimal:2',

            'shipped_at' => 'datetime',

            'delivered_at' => 'datetime',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    */

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isPending(): bool
    {
        return $this->status === ShipmentStatus::PENDING;
    }

    public function isPreparing(): bool
    {
        return $this->status === ShipmentStatus::PREPARING;
    }

    public function isShipped(): bool
    {
        return $this->status === ShipmentStatus::SHIPPED;
    }

    public function isDelivered(): bool
    {
        return $this->status === ShipmentStatus::DELIVERED;
    }

    public function isReturned(): bool
    {
        return $this->status === ShipmentStatus::RETURNED;
    }

    public function isCancelled(): bool
    {
        return $this->status === ShipmentStatus::CANCELLED;
    }

    /*
    |--------------------------------------------------------------------------
    | Regras de Negócio
    |--------------------------------------------------------------------------
    */

    public function canGenerateLabel(): bool
    {
        return $this->isPending();
    }

    public function canBeShipped(): bool
    {
        return $this->status === ShipmentStatus::PREPARING;
    }

    public function canBeDelivered(): bool
    {
        return $this->status === ShipmentStatus::SHIPPED;
    }

    public function canBeCancelled(): bool
    {
        return ! in_array(
            $this->status,
            [
                ShipmentStatus::DELIVERED,
                ShipmentStatus::RETURNED,
                ShipmentStatus::CANCELLED,
            ],
            true
        );
    }
}
