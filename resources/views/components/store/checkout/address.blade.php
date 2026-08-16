@props([
    'addresses',
])

<section
    class="
        rounded-2xl border
        border-[#E5E3DE]
        bg-white p-6
    "
>

    <div class="flex items-center justify-between">

        <div>

            <h2 class="text-lg font-bold text-[#17231F]">
                Endereço de entrega
            </h2>

            <p class="mt-1 text-sm text-[#69736F]">
                Selecione onde deseja receber seu pedido.
            </p>

        </div>

    </div>

    <div class="mt-6 space-y-3">

        @forelse($addresses as $address)

            <label
                class="
                    flex cursor-pointer gap-4
                    rounded-xl border
                    border-[#E3E1DB]
                    p-4 transition
                    hover:border-[#80958F]
                "
            >

                <input
                    type="radio"
                    name="address_id"
                    value="{{ $address->id }}"
                    @checked(
                        old(
                            'address_id',
                            $addresses
                                ->firstWhere('is_default', true)
                                ?->id
                        ) == $address->id
                    )
                    class="
                        mt-1 text-[#062B25]
                        focus:ring-[#062B25]
                    "
                >

                <div class="min-w-0">

                    <div class="flex items-center gap-2">

                        <strong class="text-sm text-[#17231F]">
                            {{ $address->label ?: 'Endereço' }}
                        </strong>

                        @if($address->is_default)

                            <span
                                class="
                                    rounded-full
                                    bg-[#EAF0EC]
                                    px-2 py-0.5
                                    text-[10px]
                                    font-semibold
                                    text-[#245447]
                                "
                            >
                                Principal
                            </span>

                        @endif

                    </div>

                    <p class="mt-2 text-sm text-[#52605C]">
                        {{ $address->recipient_name }}
                    </p>

                    <p class="mt-1 text-sm text-[#69736F]">

                        {{ $address->street }},
                        {{ $address->number }}

                        @if($address->complement)
                            — {{ $address->complement }}
                        @endif

                    </p>

                    <p class="text-sm text-[#69736F]">

                        {{ $address->neighborhood }}

                        ·

                        {{ $address->city }}/{{ $address->state }}

                    </p>

                    <p class="text-sm text-[#69736F]">
                        CEP {{ $address->cep }}
                    </p>

                </div>

            </label>

        @empty

            <div
                class="
                    rounded-xl
                    border border-dashed
                    border-[#D9D7D1]
                    p-6 text-center
                "
            >

                <p class="text-sm text-[#69736F]">
                    Você ainda não possui endereço cadastrado.
                </p>

            </div>

        @endforelse

    </div>

    <x-forms.error field="address_id" />

</section>
