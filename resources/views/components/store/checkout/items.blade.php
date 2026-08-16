@props([
    'cart',
])

<section
    class="
        rounded-2xl border
        border-[#E5E3DE]
        bg-white p-6
    "
>

    <h2 class="text-lg font-bold text-[#17231F]">
        Itens do pedido
    </h2>

    <div class="mt-6 divide-y divide-[#ECEAE6]">

        @foreach($cart->items as $item)

            <div
                class="
                    flex gap-4 py-5
                    first:pt-0
                    last:pb-0
                "
            >

                @if($item->book->primaryImage)

                    <img
                        src="{{ Storage::url(
                            $item->book->primaryImage->image
                        ) }}"
                        alt="{{ $item->book->title }}"
                        class="
                            h-24 w-16
                            shrink-0 rounded-md
                            object-cover
                        "
                    >

                @endif

                <div class="min-w-0 flex-1">

                    <p
                        class="
                            font-medium
                            text-[#17231F]
                        "
                    >
                        {{ $item->book->title }}
                    </p>

                    <p class="mt-1 text-xs text-[#69736F]">
                        {{ $item->book->authors->pluck('name')->join(', ') }}
                    </p>

                    <p class="mt-3 text-sm text-[#52605C]">
                        Quantidade: {{ $item->quantity }}
                    </p>

                </div>

                <div class="text-right">

                    @php

                        $price =
                            $item->book->sale_price
                            ?? $item->book->price;

                    @endphp

                    <strong class="text-sm text-[#17231F]">

                        R$
                        {{ number_format(
                            $price * $item->quantity,
                            2,
                            ',',
                            '.'
                        ) }}

                    </strong>

                </div>

            </div>

        @endforeach

    </div>

</section>
