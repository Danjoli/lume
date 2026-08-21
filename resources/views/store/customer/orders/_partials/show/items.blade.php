                    {{-- Itens --}}

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

                                @foreach($order->items as $item)

                                    <div
                                        class="
                                            flex gap-4 py-5
                                            first:pt-0
                                            last:pb-0
                                        "
                                    >

                                        @php
                                            $image = $item->book->images->first();
                                        @endphp

                                        @if($image)

                                            <img
                                                src="{{ Storage::url($image->image) }}"
                                                alt="{{ $item->title }}"
                                                class="
                                                    h-24 w-16
                                                    shrink-0 rounded-md
                                                    object-cover
                                                "
                                            >

                                        @else

                                            <div
                                                class="
                                                    flex h-24 w-16
                                                    shrink-0 items-center
                                                    justify-center rounded-md
                                                    bg-[#F4F2ED]
                                                "
                                            >
                                                <x-heroicon-o-book-open
                                                    class="
                                                        h-7 w-7
                                                        text-[#9BA29F]
                                                    "
                                                />
                                            </div>

                                        @endif

                                        <div class="min-w-0 flex-1">

                                            <p
                                                class="
                                                    font-medium
                                                    text-[#17231F]
                                                "
                                            >
                                                {{ $item->title }}
                                            </p>

                                            <p
                                                class="
                                                    mt-2 text-sm
                                                    text-[#69736F]
                                                "
                                            >
                                                Quantidade:
                                                {{ $item->quantity }}
                                            </p>

                                            <p
                                                class="
                                                    mt-1 text-sm
                                                    text-[#69736F]
                                                "
                                            >
                                                Unitário:
                                                R$
                                                {{ number_format(
                                                    $item->price,
                                                    2,
                                                    ',',
                                                    '.'
                                                ) }}
                                            </p>

                                        </div>

                                        <strong class="text-sm text-[#17231F]">

                                            R$

                                            {{ number_format(
                                                $item->subtotal,
                                                2,
                                                ',',
                                                '.'
                                            ) }}

                                        </strong>

                                    </div>

                                @endforeach

                            </div>

                        </section>
