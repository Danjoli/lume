<?php

namespace App\Enums;

enum CouponType: string
{
    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';

    public function label(): string
    {
        return match ($this) {

            self::FIXED => 'Valor Fixo',
            self::PERCENTAGE => 'Porcentagem',

        };
    }
}
