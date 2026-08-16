<x-store.app-layout title="Meus endereços">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mx-auto max-w-5xl">

                <div
                    class="
                        mb-8 flex flex-col gap-4
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                >

                    <div>

                        <h1
                            class="
                                text-3xl font-bold
                                tracking-[-0.03em]
                                text-[#14221E]
                            "
                        >
                            Meus endereços
                        </h1>

                        <p class="mt-2 text-sm text-[#69736F]">
                            Gerencie seus endereços de entrega.
                        </p>

                    </div>

                    <a
                        href="{{ route('store.customer.addresses.create') }}"
                        class="
                            inline-flex h-11
                            items-center justify-center
                            rounded-lg bg-[#062B25]
                            px-5 text-sm font-semibold
                            text-white
                        "
                    >
                        Novo endereço
                    </a>

                </div>

                <x-alerts.flash />

                <div class="grid gap-4 md:grid-cols-2">

                    @forelse($addresses as $address)

                        <article
                            class="
                                rounded-2xl border
                                border-[#E5E3DE]
                                bg-white p-6
                            "
                        >

                            <div class="flex justify-between gap-4">

                                <div>

                                    <div class="flex items-center gap-2">

                                        <h2 class="font-semibold text-[#17231F]">
                                            {{ $address->label ?: 'Endereço' }}
                                        </h2>

                                        @if($address->is_default)

                                            <span
                                                class="
                                                    rounded-full
                                                    bg-[#EAF0EC]
                                                    px-2.5 py-1
                                                    text-[10px]
                                                    font-semibold
                                                    text-[#245447]
                                                "
                                            >
                                                Principal
                                            </span>

                                        @endif

                                    </div>

                                    <p class="mt-4 text-sm font-medium text-[#35433F]">
                                        {{ $address->recipient_name }}
                                    </p>

                                    <p class="mt-2 text-sm leading-6 text-[#69736F]">

                                        {{ $address->street }},
                                        {{ $address->number }}

                                        @if($address->complement)
                                            — {{ $address->complement }}
                                        @endif

                                        <br>

                                        {{ $address->neighborhood }}

                                        <br>

                                        {{ $address->city }}/{{ $address->state }}

                                        <br>

                                        CEP {{ $address->cep }}

                                    </p>

                                    <p class="mt-2 text-sm text-[#69736F]">
                                        {{ $address->phone }}
                                    </p>

                                </div>

                                <x-heroicon-o-map-pin
                                    class="h-6 w-6 shrink-0 text-[#315249]"
                                />

                            </div>

                            <div
                                class="
                                    mt-6 flex flex-wrap gap-2
                                    border-t border-[#ECEAE6]
                                    pt-4
                                "
                            >

                                <a
                                    href="{{ route(
                                        'store.customer.addresses.edit',
                                        $address
                                    ) }}"
                                    class="
                                        inline-flex h-9
                                        items-center justify-center
                                        rounded-lg border
                                        border-[#DDDCD7]
                                        px-4 text-xs
                                        font-semibold text-[#35433F]
                                    "
                                >
                                    Editar
                                </a>

                                @unless($address->is_default)

                                    <form
                                        action="{{ route(
                                            'store.customer.addresses.default',
                                            $address
                                        ) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="
                                                h-9 rounded-lg
                                                border border-[#DDDCD7]
                                                px-4 text-xs
                                                font-semibold text-[#35433F]
                                            "
                                        >
                                            Tornar principal
                                        </button>

                                    </form>

                                @endunless

                                <form
                                    action="{{ route(
                                        'store.customer.addresses.destroy',
                                        $address
                                    ) }}"
                                    method="POST"
                                    class="ml-auto"
                                    onsubmit="return confirm('Deseja excluir este endereço?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="
                                            inline-flex h-9
                                            items-center justify-center
                                            rounded-lg px-3
                                            text-red-600
                                            transition
                                            hover:bg-red-50
                                        "
                                    >
                                        <x-heroicon-o-trash class="h-5 w-5" />
                                    </button>

                                </form>

                            </div>

                        </article>

                    @empty

                        <div
                            class="
                                col-span-full flex
                                min-h-[330px]
                                flex-col items-center
                                justify-center
                                rounded-2xl border
                                border-[#E5E3DE]
                                bg-white p-8
                                text-center
                            "
                        >

                            <x-heroicon-o-map-pin
                                class="h-10 w-10 text-[#8D9894]"
                            />

                            <h2 class="mt-4 font-semibold text-[#17231F]">
                                Nenhum endereço cadastrado
                            </h2>

                            <p class="mt-2 text-sm text-[#69736F]">
                                Cadastre um endereço para facilitar suas compras.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
