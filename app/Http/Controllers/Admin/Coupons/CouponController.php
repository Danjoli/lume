<?php

namespace App\Http\Controllers\Admin\Coupons;

use App\Data\Coupons\CouponData;
use App\Exceptions\Domain\InvalidCouponException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Coupons\StoreCouponRequest;
use App\Http\Requests\Admin\Coupons\UpdateCouponRequest;
use App\Models\Coupon;
use App\Services\Admin\Coupons\CouponService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{
    public function __construct(
        private readonly CouponService $couponService,
    ) {}

    /**
     * Exibe a listagem dos cupons.
     */
    public function index(Request $request): View
    {
        return view('admin.coupons.index', [

            'coupons' => $this->couponService->paginate($request),

        ]);
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create(): View
    {
        return view('admin.coupons.create');
    }

    /**
     * Armazena um novo cupom.
     */
    public function store(
        StoreCouponRequest $request
    ): RedirectResponse {

        $this->couponService->store(

            CouponData::fromRequest($request)

        );

        return redirect()

            ->route('admin.coupons.index')

            ->with(
                'success',
                'Cupom cadastrado com sucesso.'
            );

    }

    /**
     * Exibe os detalhes do cupom.
     */
    public function show(
        Coupon $coupon
    ): View {

        return view('admin.coupons.show', [

            'coupon' => $this->couponService->find($coupon),

        ]);

    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(
        Coupon $coupon
    ): View {

        return view('admin.coupons.edit', [

            'coupon' => $coupon,

        ]);

    }

    /**
     * Atualiza um cupom.
     */
    public function update(
        UpdateCouponRequest $request,
        Coupon $coupon
    ): RedirectResponse {

        $this->couponService->update(

            $coupon,

            CouponData::fromRequest($request)

        );

        return redirect()

            ->route('admin.coupons.index')

            ->with(
                'success',
                'Cupom atualizado com sucesso.'
            );

    }

    /**
     * Remove um cupom.
     */
    public function destroy(
        Coupon $coupon
    ): RedirectResponse {

        try {

            $this->couponService->destroy($coupon);

            return redirect()

                ->route('admin.coupons.index')

                ->with(
                    'success',
                    'Cupom removido com sucesso.'
                );

        } catch (InvalidCouponException $exception) {

            return redirect()

                ->route('admin.coupons.index')

                ->with(
                    'error',
                    $exception->getMessage()
                );

        }

    }

    /**
     * Ativa um cupom.
     */
    public function activate(
        Coupon $coupon
    ): RedirectResponse {

        $this->couponService->activate($coupon);

        return back()->with(
            'success',
            'Cupom ativado com sucesso.'
        );

    }

    /**
     * Desativa um cupom.
     */
    public function deactivate(
        Coupon $coupon
    ): RedirectResponse {

        $this->couponService->deactivate($coupon);

        return back()->with(
            'success',
            'Cupom desativado com sucesso.'
        );

    }
}
