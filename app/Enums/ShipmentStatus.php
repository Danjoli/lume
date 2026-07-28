<?php

namespace App\Enums;

enum ShipmentStatus: string
{
    case PENDING = 'pending';

    case PREPARING = 'preparing';

    case SHIPPED = 'shipped';

    case DELIVERED = 'delivered';

    case RETURNED = 'returned';
}
