<?php

namespace App\Enums;

enum ShipmentStatus: string
{
    case PENDING = 'pending';
    case PREPARING = 'preparing';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case RETURNED = 'returned';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {

            self::PENDING => 'Pendente',
            self::PREPARING => 'Preparando',
            self::SHIPPED => 'Enviado',
            self::DELIVERED => 'Entregue',
            self::RETURNED => 'Devolvido',
            self::CANCELLED => 'Cancelado',

        };
    }

    public function color(): string
    {
        return match ($this) {

            self::PENDING => 'yellow',
            self::PREPARING => 'blue',
            self::SHIPPED => 'purple',
            self::DELIVERED => 'green',
            self::RETURNED => 'orange',
            self::CANCELLED => 'red',

        };
    }

    public function badge(): string
    {
        return match ($this) {

            self::PENDING => 'bg-yellow-100 text-yellow-800',
            self::PREPARING => 'bg-blue-100 text-blue-800',
            self::SHIPPED => 'bg-purple-100 text-purple-800',
            self::DELIVERED => 'bg-green-100 text-green-800',
            self::RETURNED => 'bg-orange-100 text-orange-800',
            self::CANCELLED => 'bg-red-100 text-red-800',

        };
    }
}
