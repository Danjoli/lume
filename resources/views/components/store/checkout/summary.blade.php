@props([
    'cart',
])

@php

$subtotal = $cart->items->sum(
    function ($item) {

        $price =
            $item->book->sale_price
            ?? $item->book->price;

        return $price * $item->quantity;
    }
);

@endphp

<aside
    class="
        sticky top-6
        rounded-2xl border
        border-[#E5E3DE]
        bg-white p-6
    "
>

    <h2 class="text-lg font-bold text-[#17231F]">
        Resumo do pedido
    </h2>

    <dl class="mt-6 space-y-4">

        <div class="flex justify-between text-sm">

            <dt class="text-[#69736F]">
                Subtotal
            </dt>

            <dd class="font-medium text-[#17231F]">
                R$ {{ number_format($subtotal, 2, ',', '.') }}
            </dd>

        </div>

        <div class="flex justify-between text-sm">

            <dt class="text-[#69736F]">
                Frete
            </dt>

            <dd class="font-medium text-[#286347]">
                Grátis
            </dd>

        </div>

        <div class="flex justify-between text-sm">

            <dt class="text-[#69736F]">
                Desconto
            </dt>

            <dd class="text-[#17231F]">
                R$ 0,00
            </dd>

        </div>

        <div
            class="
                flex items-end justify-between
                border-t border-[#ECEAE6]
                pt-5
            "
        >

            <dt class="font-semibold text-[#17231F]">
                Total
            </dt>

            <dd
                class="
                    text-2xl font-bold
                    text-[#17231F]
                "
            >
                R$ {{ number_format($subtotal, 2, ',', '.') }}
            </dd>

        </div>

    </dl>

    <button
        type="submit"
        class="
            mt-7 flex h-12 w-full
            items-center justify-center
            rounded-lg bg-[#062B25]
            px-6 text-sm
            font-semibold text-white
            transition
            hover:bg-[#0B3C34]
        "
    >
        Finalizar pedido
    </button>

    <div
        class="
            mt-5 flex items-center
            justify-center gap-2
            text-xs text-[#69736F]
        "
    >

        <x-heroicon-o-lock-closed class="h-4 w-4" />

        Compra segura

    </div>

</aside>
