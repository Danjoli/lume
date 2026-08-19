@props([
    'addresses',
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
            1
        </span>

        <div>
            <h2 class="text-lg font-bold text-[#17231F]">
                Endereço de entrega
            </h2>

            <p class="mt-1 text-sm text-[#69736F]">
                Escolha onde deseja receber seu pedido.
            </p>
        </div>

    </div>

    @if($addresses->isNotEmpty())

        <div class="mt-6 space-y-3">

            @foreach($addresses as $address)

                <label
                    class="
                        flex cursor-pointer items-start gap-4
                        rounded-xl border border-[#E5E3DE]
                        p-4 transition
                        hover:border-[#BFCAC6]
                        has-[:checked]:border-[#062B25]
                        has-[:checked]:bg-[#F7FAF8]
                    "
                >

                    <input
                        type="radio"
                        name="address_id"
                        value="{{ $address->id }}"
                        @checked(
                            old('address_id', $addresses->firstWhere('is_default', true)?->id)
                                == $address->id
                        )
                        class="
                            mt-1 h-4 w-4
                            border-[#BFC5C2]
                            text-[#062B25]
                            focus:ring-[#062B25]
                        "
                    >

                    <div class="min-w-0 flex-1">

                        <div class="flex flex-wrap items-center gap-2">

                            <strong class="text-sm text-[#17231F]">
                                {{ $address->label ?? 'Endereço' }}
                            </strong>

                            @if($address->is_default)

                                <span
                                    class="
                                        rounded-full bg-[#EDF0EC]
                                        px-2.5 py-1
                                        text-[10px] font-semibold
                                        text-[#315249]
                                    "
                                >
                                    Principal
                                </span>

                            @endif

                        </div>

                        <p class="mt-2 text-sm leading-6 text-[#69736F]">
                            {{ $address->recipient_name }}
                        </p>

                        <p class="text-sm leading-6 text-[#69736F]">
                            {{ $address->street }},
                            {{ $address->number }}

                            @if($address->complement)
                                — {{ $address->complement }}
                            @endif
                        </p>

                        <p class="text-sm leading-6 text-[#69736F]">
                            {{ $address->neighborhood }}
                            · {{ $address->city }} - {{ $address->state }}
                        </p>

                        <p class="text-sm leading-6 text-[#69736F]">
                            CEP {{ $address->cep }}
                        </p>

                    </div>

                </label>

            @endforeach

        </div>

        @error('address_id')
            <p class="mt-3 text-xs text-red-600">
                {{ $message }}
            </p>
        @enderror

        <div class="mt-5 flex flex-wrap items-center gap-4">

            <a
                href="{{ route('store.customer.addresses.create') }}"
                class="
                    inline-flex items-center gap-2
                    text-sm font-semibold
                    text-[#315249]
                    transition hover:text-[#062B25]
                "
            >
                <x-heroicon-o-plus class="h-4 w-4" />

                Adicionar novo endereço
            </a>

            <a
                href="{{ route('store.customer.addresses.index') }}"
                class="
                    text-sm font-medium
                    text-[#69736F]
                    transition hover:text-[#315249]
                "
            >
                Gerenciar endereços
            </a>

        </div>

    @else

        <div
            class="
                mt-6 rounded-xl
                border border-dashed border-[#D8D6D0]
                bg-[#F8F7F4] p-6
                text-center
            "
        >

            <x-heroicon-o-map-pin
                class="mx-auto h-8 w-8 text-[#8A918E]"
            />

            <h3 class="mt-3 font-semibold text-[#17231F]">
                Nenhum endereço cadastrado
            </h3>

            <p
                class="
                    mx-auto mt-2 max-w-md
                    text-sm leading-6 text-[#69736F]
                "
            >
                Cadastre um endereço para calcular o frete
                e continuar com a compra.
            </p>

            <a
                href="{{ route('store.customer.addresses.create') }}"
                class="
                    mt-5 inline-flex h-10
                    items-center justify-center
                    rounded-lg bg-[#062B25]
                    px-5 text-sm font-semibold
                    text-white transition
                    hover:bg-[#0B3C34]
                "
            >
                Adicionar endereço
            </a>

        </div>

    @endif

</section>
