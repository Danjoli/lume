<?php

namespace App\Actions\Coupons;

use App\Models\Coupon;

class DeactivateCouponAction
{
    /**
     * Desativa um cupom.
     */
    public function execute(
        Coupon $coupon
    ): Coupon {

        $coupon->update([

            'is_active' => false,

        ]);

        return $coupon->refresh();

    }
}
