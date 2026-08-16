<?php

namespace App\Actions\Coupons;

use App\Data\Coupons\CouponData;
use App\Models\Coupon;

class CreateCouponAction
{
    /**
     * Cria um cupom.
     */
    public function execute(
        CouponData $data
    ): Coupon {

        return Coupon::create(
            $data->toArray()
        );

    }
}
