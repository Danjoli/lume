<?php

namespace App\Enums;

enum AdminRole: string
{
    case SUPERADMIN = 'superadmin';
    case ADMIN = 'admin';
    case SUPORTE = 'suporte';

    public function label(): string
    {
        return match ($this) {
            self::SUPERADMIN => 'Super Administrador',
            self::ADMIN => 'Administrador',
            self::SUPORTE => 'Suporte',
        };
    }
}
