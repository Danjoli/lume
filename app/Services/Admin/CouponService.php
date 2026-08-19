<?php

namespace App\Services\Admin;

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

    /**
     * Lista paginada dos cupons.
     */
    public function paginate(
        Request $request
    ): LengthAwarePaginator {
        return Coupon::query()

            ->when(
                $request->filled('search'),
                function ($query) use ($request) {

                    $query->where(
                        function ($query) use ($request) {

                            $query
                                ->where(
                                    'code',
                                    'like',
                                    "%{$request->search}%"
                                )
                                ->orWhere(
                                    'description',
                                    'like',
                                    "%{$request->search}%"
                                );
                        }
                    );
                }
            )

            ->when(
                $request->filled('type'),
                fn ($query) => $query->where(
                    'type',
                    $request->type
                )
            )

            ->when(
                $request->filled('status'),
                fn ($query) => $query->where(
                    'is_active',
                    $request->boolean('status')
                )
            )

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
        return Coupon::create(
            $data->toArray()
        );
    }

    /**
     * Atualiza um cupom.
     */
    public function update(
        Coupon $coupon,
        CouponData $data
    ): Coupon {
        $coupon->update(
            $data->toArray()
        );

        return $coupon->refresh();
    }

    /**
     * Remove um cupom.
     */
    public function destroy(
        Coupon $coupon
    ): void {
        $coupon->delete();
    }

    /**
     * Ativa um cupom.
     */
    public function activate(
        Coupon $coupon
    ): Coupon {
        $coupon->update([
            'is_active' => true,
        ]);

        return $coupon->refresh();
    }

    /**
     * Desativa um cupom.
     */
    public function deactivate(
        Coupon $coupon
    ): Coupon {
        $coupon->update([
            'is_active' => false,
        ]);

        return $coupon->refresh();
    }

    /**
     * Incrementa o número de utilizações.
     */
    public function incrementUsage(
        Coupon $coupon
    ): Coupon {
        $coupon->increment('used_count');

        return $coupon->refresh();
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
