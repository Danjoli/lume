@props([
    'shippingOptions' => collect(),
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
            3
        </span>

        <div>

            <h2 class="text-lg font-bold text-[#17231F]">
                Forma de entrega
            </h2>

            <p class="mt-1 text-sm text-[#69736F]">
                Escolha como deseja receber seu pedido.
            </p>

        </div>

    </div>

    @if($shippingOptions->isNotEmpty())

        <div class="mt-6 space-y-3">

            @foreach($shippingOptions as $option)

                <label
                    class="
                        flex cursor-pointer items-center gap-4
                        rounded-xl border border-[#E5E3DE]
                        p-4 transition
                        hover:border-[#BFCAC6]
                        has-[:checked]:border-[#062B25]
                        has-[:checked]:bg-[#F7FAF8]
                    "
                >

                    <input
                        type="radio"
                        name="shipping_service"
                        value="{{ $option['id'] }}"
                        @checked(
                            old('shipping_service')
                                == $option['id']
                        )
                        class="
                            h-4 w-4
                            border-[#BFC5C2]
                            text-[#062B25]
                            focus:ring-[#062B25]
                        "
                    >

                    <div class="flex min-w-0 flex-1 items-center gap-4">

                        <div
                            class="
                                flex h-11 w-11 shrink-0
                                items-center justify-center
                                rounded-xl bg-[#EDF0EC]
                                text-[#315249]
                            "
                        >
                            <x-heroicon-o-truck class="h-5 w-5" />
                        </div>

                        <div class="min-w-0 flex-1">

                            <div
                                class="
                                    flex flex-wrap items-center
                                    justify-between gap-2
                                "
                            >

                                <strong class="text-sm text-[#17231F]">
                                    {{ $option['name'] }}
                                </strong>

                                <strong class="text-sm text-[#17231F]">
                                    R$ {{ number_format(
                                        $option['price'],
                                        2,
                                        ',',
                                        '.'
                                    ) }}
                                </strong>

                            </div>

                            <p class="mt-1 text-xs text-[#69736F]">
                                Entrega em
                                {{ $option['delivery_time'] }}
                                dias úteis
                            </p>

                        </div>

                    </div>

                </label>

            @endforeach

        </div>

        @error('shipping_service')
            <p class="mt-3 text-xs text-red-600">
                {{ $message }}
            </p>
        @enderror

    @else

        <div
            class="
                mt-6 flex items-start gap-4
                rounded-xl bg-[#F7F6F2]
                p-5
            "
        >

            <div
                class="
                    flex h-10 w-10 shrink-0
                    items-center justify-center
                    rounded-xl bg-white
                    text-[#315249]
                "
            >
                <x-heroicon-o-truck class="h-5 w-5" />
            </div>

            <div>

                <h3 class="text-sm font-semibold text-[#17231F]">
                    Frete ainda não calculado
                </h3>

                <p class="mt-1 text-sm leading-6 text-[#69736F]">
                    Selecione um endereço de entrega para consultar
                    as opções e valores de frete disponíveis.
                </p>

            </div>

        </div>

    @endif

</section>
