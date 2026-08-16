<?php

namespace App\Services\Admin\Coupons;

use App\Actions\Coupons\ActivateCouponAction;
use App\Actions\Coupons\CreateCouponAction;
use App\Actions\Coupons\DeactivateCouponAction;
use App\Actions\Coupons\DeleteCouponAction;
use App\Actions\Coupons\IncrementCouponUsageAction;
use App\Actions\Coupons\UpdateCouponAction;
use App\Data\Coupons\CouponData;
use App\Exceptions\Domain\InvalidCouponException;
use App\Models\Coupon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class CouponService
{
    /**
     * Quantidade de registros por página.
     */
    private const PER_PAGE = 10;

    public function __construct(
        private readonly CreateCouponAction $createCouponAction,
        private readonly UpdateCouponAction $updateCouponAction,
        private readonly DeleteCouponAction $deleteCouponAction,
        private readonly ActivateCouponAction $activateCouponAction,
        private readonly DeactivateCouponAction $deactivateCouponAction,
        private readonly IncrementCouponUsageAction $incrementCouponUsageAction,
    ) {
    }

    /**
     * Lista paginada dos cupons.
     */
    public function paginate(
        Request $request
    ): LengthAwarePaginator {

        return Coupon::query()

            ->when($request->filled('search'), function ($query) use ($request) {

                $query->where(function ($query) use ($request) {

                    $query

                        ->where('code', 'like', "%{$request->search}%")

                        ->orWhere('description', 'like', "%{$request->search}%");

                });

            })

            ->when($request->filled('type'), function ($query) use ($request) {

                $query->where(
                    'type',
                    $request->type
                );

            })

            ->when($request->filled('status'), function ($query) use ($request) {

                $query->where(
                    'is_active',
                    $request->boolean('status')
                );

            })

            ->latest()

            ->paginate(self::PER_PAGE)

            ->withQueryString();

    }

    /**
     * Retorna um cupom.
     */
    public function find(
        Coupon $coupon
    ): Coupon {

        return $coupon;

    }

    /**
     * Cadastra um cupom.
     */
    public function store(
        CouponData $data
    ): Coupon {

        return $this->createCouponAction
            ->execute($data);

    }

    /**
     * Atualiza um cupom.
     */
    public function update(
        Coupon $coupon,
        CouponData $data
    ): Coupon {

        return $this->updateCouponAction
            ->execute(
                $coupon,
                $data
            );

    }

    /**
     * Remove um cupom.
     */
    public function destroy(
        Coupon $coupon
    ): void {

        $this->deleteCouponAction
            ->execute($coupon);

    }

    /**
     * Ativa um cupom.
     */
    public function activate(
        Coupon $coupon
    ): Coupon {

        return $this->activateCouponAction
            ->execute($coupon);

    }

    /**
     * Desativa um cupom.
     */
    public function deactivate(
        Coupon $coupon
    ): Coupon {

        return $this->deactivateCouponAction
            ->execute($coupon);

    }

    /**
     * Incrementa o número de utilizações.
     */
    public function incrementUsage(
        Coupon $coupon
    ): void {

        $this->incrementCouponUsageAction
            ->execute($coupon);

    }

    /**
     * Verifica se um cupom pode ser utilizado.
     */
    public function validate(
        Coupon $coupon,
        float $subtotal
    ): void {

        if (! $coupon->canBeUsed()) {

            throw new InvalidCouponException(
                'Este cupom não está disponível.'
            );

        }

        if ($subtotal < $coupon->minimum_amount) {

            throw new InvalidCouponException(
                'O valor mínimo para utilizar este cupom é R$ '
                . number_format(
                    $coupon->minimum_amount,
                    2,
                    ',',
                    '.'
                )
            );

        }

    }
}
