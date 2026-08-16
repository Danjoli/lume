<?php

namespace App\Actions\Coupons;

use App\Models\Coupon;

class DeleteCouponAction
{
    /**
     * Remove um cupom.
     */
    public function execute(
        Coupon $coupon
    ): void {

        $coupon->delete();

    }
}
