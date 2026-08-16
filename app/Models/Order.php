<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * Campos preenchíveis.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',

        'status',
        'payment_status',

        'subtotal',
        'shipping',
        'discount',
        'total',

        'recipient_name',
        'phone',

        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'cep',

        'gateway',
        'gateway_payment_id',

        'paid_at',
    ];

    /**
     * Conversões de atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

            'status' => OrderStatus::class,

            'payment_status' => PaymentStatus::class,

            'subtotal' => 'decimal:2',

            'shipping' => 'decimal:2',

            'discount' => 'decimal:2',

            'total' => 'decimal:2',

            'paid_at' => 'datetime',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers - Status do Pedido
    |--------------------------------------------------------------------------
    */

    public function isPending(): bool
    {
        return $this->status === OrderStatus::PENDING;
    }

    public function isProcessing(): bool
    {
        return $this->status === OrderStatus::PROCESSING;
    }

    public function isShipped(): bool
    {
        return $this->status === OrderStatus::SHIPPED;
    }

    public function isDelivered(): bool
    {
        return $this->status === OrderStatus::DELIVERED;
    }

    public function isCancelled(): bool
    {
        return $this->status === OrderStatus::CANCELLED;
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers - Status do Pagamento
    |--------------------------------------------------------------------------
    */

    public function isPaymentPending(): bool
    {
        return $this->payment_status === PaymentStatus::PENDING;
    }

    public function isPaid(): bool
    {
        return $this->payment_status === PaymentStatus::PAID;
    }

    public function isPaymentFailed(): bool
    {
        return $this->payment_status === PaymentStatus::FAILED;
    }

    public function isRefunded(): bool
    {
        return $this->payment_status === PaymentStatus::REFUNDED;
    }

    /*
    |--------------------------------------------------------------------------
    | Regras de Negócio
    |--------------------------------------------------------------------------
    */

    public function canBeProcessed(): bool
    {
        return $this->status === OrderStatus::PENDING;
    }

    public function canBeShipped(): bool
    {
        return $this->status === OrderStatus::PROCESSING;
    }

    public function canBeDelivered(): bool
    {
        return $this->status === OrderStatus::SHIPPED;
    }

    public function canBeCancelled(): bool
    {
        return ! in_array(
            $this->status,
            [
                OrderStatus::DELIVERED,
                OrderStatus::CANCELLED,
            ],
            true
        );
    }

    public function canBeRefunded(): bool
    {
        return $this->payment_status === PaymentStatus::PAID;
    }
}
