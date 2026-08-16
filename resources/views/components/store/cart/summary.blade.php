@props([
    'cart',
])

<aside
    class="
        sticky top-6
        rounded-2xl border
        border-[#E5E3DE]
        bg-white p-6
    "
>

    <h2 class="text-lg font-bold text-[#17231F]">
        Resumo
    </h2>

    <dl class="mt-6 space-y-4">

        <div class="flex justify-between text-sm">

            <dt class="text-[#69736F]">
                Subtotal
            </dt>

            <dd class="font-medium text-[#17231F]">
                R$ {{ number_format($cart->subtotal, 2, ',', '.') }}
            </dd>

        </div>

        <div class="flex justify-between text-sm">

            <dt class="text-[#69736F]">
                Frete
            </dt>

            <dd class="text-[#17231F]">
                Calculado no checkout
            </dd>

        </div>

        <div
            class="
                flex justify-between
                border-t border-[#ECEAE6]
                pt-4
            "
        >

            <dt class="font-semibold text-[#17231F]">
                Total
            </dt>

            <dd class="text-xl font-bold text-[#17231F]">
                R$ {{ number_format($cart->subtotal, 2, ',', '.') }}
            </dd>

        </div>

    </dl>

    <a
        href="{{ route('store.checkout.index') }}"
        class="
            mt-6 flex h-12 w-full
            items-center justify-center
            rounded-lg bg-[#062B25]
            px-6 text-sm font-semibold
            text-white transition
            hover:bg-[#0B3C34]
        "
    >
        Continuar para o checkout
    </a>

    <a
        href="{{ route('store.catalog.index') }}"
        class="
            mt-3 flex h-11 w-full
            items-center justify-center
            rounded-lg border border-[#DDDCD7]
            text-sm font-semibold text-[#35433F]
            transition hover:bg-[#F7F6F2]
        "
    >
        Continuar comprando
    </a>

</aside>
