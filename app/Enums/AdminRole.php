<?php

namespace App\Enums;

enum AdminRole: string
{
    case SUPPORT = 'suporte';
    case ADMIN = 'admin';
    case SUPERADMIN = 'superadmin';
}
