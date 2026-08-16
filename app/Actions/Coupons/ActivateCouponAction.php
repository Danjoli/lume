<?php

namespace App\Actions\Coupons;

use App\Models\Coupon;

class ActivateCouponAction
{
    /**
     * Ativa um cupom.
     */
    public function execute(
        Coupon $coupon
    ): Coupon {

        $coupon->update([

            'is_active' => true,

        ]);

        return $coupon->refresh();

    }
}
