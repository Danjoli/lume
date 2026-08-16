<?php

namespace App\Actions\Coupons;

use App\Data\Coupons\CouponData;
use App\Models\Coupon;

class UpdateCouponAction
{
    /**
     * Atualiza um cupom.
     */
    public function execute(
        Coupon $coupon,
        CouponData $data
    ): Coupon {

        $coupon->update(
            $data->toArray()
        );

        return $coupon->refresh();

    }
}
