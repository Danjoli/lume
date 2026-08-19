@props([
    'cart',
])

<section
    class="
        rounded-2xl border border-[#E5E3DE]
        bg-white p-6
    "
>

    <div class="flex items-center gap-3">

        <span
            class="
                flex h-8 w-8 items-center justify-center
                rounded-full bg-[#062B25]
                text-sm font-bold text-white
            "
        >
            5
        </span>

        <div>

            <h2 class="text-lg font-bold text-[#17231F]">
                Revisar itens
            </h2>

            <p class="mt-1 text-sm text-[#69736F]">
                Confira os livros e quantidades antes de finalizar o pedido.
            </p>

        </div>

    </div>

    <div class="mt-6 divide-y divide-[#ECEAE6]">

        @foreach($cart->items as $item)

            <div
                class="
                    flex gap-4 py-5
                    first:pt-0
                    last:pb-0
                "
            >

                {{-- Imagem --}}
                <a
                    href="{{ route('store.books.show', $item->book) }}"
                    class="shrink-0"
                >

                    @php
                        $image = $item->book->images->first();
                    @endphp

                    @if($image)

                        <img
                            src="{{ Storage::url($image->image) }}"
                            alt="{{ $item->book->title }}"
                            class="
                                h-24 w-16
                                rounded-md object-cover
                            "
                        >

                    @else

                        <div
                            class="
                                flex h-24 w-16
                                items-center justify-center
                                rounded-md bg-[#F4F2ED]
                            "
                        >
                            <x-heroicon-o-book-open
                                class="h-6 w-6 text-[#9BA29F]"
                            />
                        </div>

                    @endif

                </a>

                {{-- Informações --}}
                <div class="flex min-w-0 flex-1 flex-col">

                    <div
                        class="
                            flex items-start
                            justify-between gap-4
                        "
                    >

                        <div class="min-w-0">

                            <a
                                href="{{ route(
                                    'store.books.show',
                                    $item->book
                                ) }}"
                                class="
                                    line-clamp-2
                                    text-sm font-semibold
                                    leading-5 text-[#17231F]
                                    transition
                                    hover:text-[#0D5147]
                                "
                            >
                                {{ $item->book->title }}
                            </a>

                            <p
                                class="
                                    mt-1 truncate
                                    text-xs text-[#69736F]
                                "
                            >
                                {{ $item->book->authors
                                    ->pluck('name')
                                    ->join(', ') }}
                            </p>

                        </div>

                        <strong
                            class="
                                shrink-0 text-sm
                                text-[#17231F]
                            "
                        >
                            R$ {{ number_format(
                                $item->subtotal,
                                2,
                                ',',
                                '.'
                            ) }}
                        </strong>

                    </div>

                    <div
                        class="
                            mt-auto flex flex-wrap
                            items-end justify-between
                            gap-3 pt-3
                        "
                    >

                        <div class="text-xs text-[#69736F]">

                            <span>
                                Quantidade:
                                <strong class="text-[#394844]">
                                    {{ $item->quantity }}
                                </strong>
                            </span>

                            <span class="mx-2">
                                •
                            </span>

                            <span>
                                Unitário:
                                <strong class="text-[#394844]">
                                    R$ {{ number_format(
                                        $item->book->current_price,
                                        2,
                                        ',',
                                        '.'
                                    ) }}
                                </strong>
                            </span>

                        </div>

                        <a
                            href="{{ route('store.cart.index') }}"
                            class="
                                text-xs font-semibold
                                text-[#315249]
                                transition
                                hover:text-[#062B25]
                            "
                        >
                            Editar carrinho
                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</section>
