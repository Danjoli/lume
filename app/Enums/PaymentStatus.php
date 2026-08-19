<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case REFUNDED = 'refunded';
    case FAILED = 'failed';

    public function label(): string
    {
        return match ($this) {

            self::PENDING => 'Pendente',
            self::PAID => 'Pago',
            self::REFUNDED => 'Reembolsado',
            self::FAILED => 'Falhou',

        };
    }

    public function color(): string
    {
        return match ($this) {

            self::PENDING => 'yellow',
            self::PAID => 'green',
            self::REFUNDED => 'gray',
            self::FAILED => 'red',

        };
    }
}
