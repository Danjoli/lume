<x-store.app-layout title="Pedido realizado">

    <section class="py-16">

        <x-store.ui.container>

            <div
                class="
                    mx-auto max-w-2xl
                    rounded-2xl border
                    border-[#E5E3DE]
                    bg-white p-10
                    text-center
                "
            >

                <div
                    class="
                        mx-auto flex
                        h-16 w-16
                        items-center justify-center
                        rounded-full
                        bg-[#EAF0EC]
                    "
                >

                    <x-heroicon-o-check
                        class="h-8 w-8 text-[#286347]"
                    />

                </div>

                <h1
                    class="
                        mt-6 text-2xl
                        font-bold text-[#17231F]
                    "
                >
                    Pedido realizado!
                </h1>

                <p
                    class="
                        mt-3 text-sm
                        leading-6 text-[#69736F]
                    "
                >
                    Seu pedido foi criado com sucesso.
                    Agora você pode continuar para o pagamento.
                </p>

                <div
                    class="
                        mt-7 rounded-xl
                        bg-[#F6F5F1]
                        p-5
                    "
                >

                    <p class="text-xs text-[#69736F]">
                        Número do pedido
                    </p>

                    <strong
                        class="
                            mt-1 block
                            text-xl text-[#17231F]
                        "
                    >
                        #{{ $order->id }}
                    </strong>

                    <p class="mt-4 text-xs text-[#69736F]">
                        Total
                    </p>

                    <strong
                        class="
                            mt-1 block
                            text-xl text-[#17231F]
                        "
                    >
                        R$
                        {{ number_format(
                            $order->total,
                            2,
                            ',',
                            '.'
                        ) }}
                    </strong>

                </div>

                <div
                    class="
                        mt-7 flex
                        flex-col gap-3
                        sm:flex-row
                        sm:justify-center
                    "
                >

                    <a
                        href="{{ route('store.catalog.index') }}"
                        class="
                            inline-flex h-11
                            items-center justify-center
                            rounded-lg border
                            border-[#DDDCD7]
                            px-6 text-sm
                            font-semibold text-[#35433F]
                        "
                    >
                        Continuar comprando
                    </a>

                    <a
                        href="#"
                        class="
                            inline-flex h-11
                            items-center justify-center
                            rounded-lg bg-[#062B25]
                            px-6 text-sm
                            font-semibold text-white
                        "
                    >
                        Ir para pagamento
                    </a>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
