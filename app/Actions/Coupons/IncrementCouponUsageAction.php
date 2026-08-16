<?php

namespace App\Actions\Coupons;

use App\Models\Coupon;

class IncrementCouponUsageAction
{
    /**
     * Incrementa a quantidade de utilizações do cupom.
     */
    public function execute(
        Coupon $coupon
    ): Coupon {

        $coupon->increment('used_count');

        return $coupon->refresh();

    }
}
