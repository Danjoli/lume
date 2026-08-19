<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case PIX = 'pix';
    case CARD = 'card';
    case BOLETO = 'boleto';

    public function label(): string
    {
        return match ($this) {
            self::PIX => 'PIX',
            self::CARD => 'Cartão de crédito',
            self::BOLETO => 'Boleto bancário',
        };
    }
}
