@props([
    'cart',
    'shippingPrice' => 0,
])

@php
    $subtotal = $cart->items->sum(
        fn ($item) => $item->subtotal
    );

    $shipping = (float) $shippingPrice;

    $total = $subtotal + $shipping;
@endphp

<aside
    class="
        rounded-2xl border border-[#E5E3DE]
        bg-white p-6
    "
>

    <h2 class="text-lg font-bold text-[#17231F]">
        Resumo do pedido
    </h2>

    <div class="mt-5 space-y-3">

        <div class="flex items-center justify-between gap-4">

            <span class="text-sm text-[#69736F]">
                Subtotal
            </span>

            <span class="text-sm font-semibold text-[#17231F]">
                R$ {{ number_format(
                    $subtotal,
                    2,
                    ',',
                    '.'
                ) }}
            </span>

        </div>

        <div class="flex items-center justify-between gap-4">

            <span class="text-sm text-[#69736F]">
                Frete
            </span>

            @if($shipping > 0)

                <span class="text-sm font-semibold text-[#17231F]">
                    R$ {{ number_format(
                        $shipping,
                        2,
                        ',',
                        '.'
                    ) }}
                </span>

            @else

                <span class="text-xs text-[#8A918E]">
                    Selecione uma opção
                </span>

            @endif

        </div>

    </div>

    <div class="my-5 border-t border-[#ECEAE6]"></div>

    <div class="flex items-end justify-between gap-4">

        <div>

            <p class="text-sm font-semibold text-[#17231F]">
                Total
            </p>

            <p class="mt-1 text-xs text-[#8A918E]">
                Valor final do pedido
            </p>

        </div>

        <strong
            class="
                text-xl font-bold
                text-[#17231F]
            "
        >
            R$ {{ number_format(
                $total,
                2,
                ',',
                '.'
            ) }}
        </strong>

    </div>

    <button
        type="submit"
        class="
            mt-6 flex h-12 w-full
            items-center justify-center
            rounded-lg bg-[#062B25]
            px-6 text-sm font-semibold
            text-white transition
            hover:bg-[#0B3C34]
        "
    >
        Finalizar pedido
    </button>

    <div
        class="
            mt-5 flex items-start gap-3
            rounded-xl bg-[#F7F6F2]
            p-4
        "
    >

        <x-heroicon-o-shield-check
            class="
                mt-0.5 h-5 w-5
                shrink-0 text-[#315249]
            "
        />

        <p class="text-xs leading-5 text-[#69736F]">
            Seus dados são utilizados apenas para processar
            o pedido, pagamento e entrega.
        </p>

    </div>

</aside>
