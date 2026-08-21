<x-store.app-layout title="Pedido realizado">

    <section class="py-14 lg:py-20">

        <x-store.ui.container>

            <div class="mx-auto max-w-3xl">

                <div
                    class="
                        rounded-2xl border
                        border-[#E5E3DE]
                        bg-white p-6
                        sm:p-8 lg:p-10
                    "
                >

                    {{-- Confirmação --}}
                    <div class="text-center">

                        <div
                            class="
                                mx-auto flex h-16 w-16
                                items-center justify-center
                                rounded-full
                                bg-[#EAF0EC]
                            "
                        >
                            <x-heroicon-o-check
                                class="h-8 w-8 text-[#286347]"
                            />
                        </div>

                        <span
                            class="
                                mt-5 inline-flex
                                rounded-full bg-[#EDF0EC]
                                px-3 py-1.5
                                text-xs font-semibold
                                text-[#315249]
                            "
                        >
                            Pedido recebido
                        </span>

                        <h1
                            class="
                                mt-4 text-3xl
                                font-bold tracking-[-0.03em]
                                text-[#17231F]
                            "
                        >
                            Pedido realizado com sucesso!
                        </h1>

                        <p
                            class="
                                mx-auto mt-3 max-w-xl
                                text-sm leading-6
                                text-[#69736F]
                            "
                        >
                            Seu pedido foi criado e já está registrado.
                            Confira abaixo os principais detalhes da sua compra.
                        </p>

                    </div>

                    {{-- Resumo --}}
                    <div
                        class="
                            mt-8 grid gap-4
                            rounded-2xl bg-[#F6F5F1]
                            p-5 sm:grid-cols-2
                        "
                    >

                        <div>

                            <p class="text-xs text-[#69736F]">
                                Número do pedido
                            </p>

                            <strong
                                class="
                                    mt-1 block
                                    text-lg text-[#17231F]
                                "
                            >
                                #{{ $order->id }}
                            </strong>

                        </div>

                        <div class="sm:text-right">

                            <p class="text-xs text-[#69736F]">
                                Total
                            </p>

                            <strong
                                class="
                                    mt-1 block
                                    text-lg text-[#17231F]
                                "
                            >
                                R$ {{ number_format(
                                    $order->total,
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </strong>

                        </div>

                    </div>

                    {{-- Informações --}}
                    <div
                        class="
                            mt-8 grid gap-6
                            border-t border-[#ECEAE6]
                            pt-8 sm:grid-cols-2
                        "
                    >

                        {{-- Pagamento --}}
                        <div>

                            <div class="flex items-center gap-2">

                                <x-heroicon-o-credit-card
                                    class="h-5 w-5 text-[#315249]"
                                />

                                <h2 class="font-semibold text-[#17231F]">
                                    Pagamento
                                </h2>

                            </div>

                            <p class="mt-2 text-sm text-[#69736F]">
                                {{ $order->payment_method->label() }}
                            </p>

                            <p class="mt-1 text-xs text-[#8A918E]">
                                Status:
                                {{ $order->payment_status->value }}
                            </p>

                        </div>

                        {{-- Entrega --}}
                        <div>

                            <div class="flex items-center gap-2">

                                <x-heroicon-o-map-pin
                                    class="h-5 w-5 text-[#315249]"
                                />

                                <h2 class="font-semibold text-[#17231F]">
                                    Entrega
                                </h2>

                            </div>

                            <p class="mt-2 text-sm leading-6 text-[#69736F]">
                                {{ $order->street }},
                                {{ $order->number }}
                            </p>

                            <p class="text-sm leading-6 text-[#69736F]">
                                {{ $order->city }} - {{ $order->state }}
                            </p>

                            <p class="text-xs text-[#8A918E]">
                                CEP {{ $order->cep }}
                            </p>

                        </div>

                    </div>

                    {{-- Próximo passo --}}
                    <div
                        class="
                            mt-8 flex items-start gap-4
                            rounded-xl
                            border border-[#E5E3DE]
                            p-5
                        "
                    >

                        <div
                            class="
                                flex h-10 w-10 shrink-0
                                items-center justify-center
                                rounded-xl bg-[#EDF0EC]
                                text-[#315249]
                            "
                        >
                            <x-heroicon-o-information-circle
                                class="h-5 w-5"
                            />
                        </div>

                        <div>

                            <h2 class="text-sm font-semibold text-[#17231F]">
                                Próximo passo
                            </h2>

                            <p class="mt-1 text-sm leading-6 text-[#69736F]">

                                @switch($order->payment_method)

                                    @case(\App\Enums\PaymentMethod::PIX)

                                        Continue para o pagamento para gerar
                                        o QR Code e o código PIX.

                                        @break

                                    @case(\App\Enums\PaymentMethod::BOLETO)

                                        Continue para o pagamento para gerar
                                        seu boleto bancário.

                                        @break

                                    @case(\App\Enums\PaymentMethod::CARD)

                                        Continue para informar os dados
                                        do cartão e concluir o pagamento.

                                        @break

                                @endswitch

                            </p>

                        </div>

                    </div>

                    {{-- Ações --}}
                    <div
                        class="
                            mt-8 flex flex-col gap-3
                            sm:flex-row sm:justify-between
                        "
                    >

                        <a
                            href="{{ route(
                                'store.customer.orders.show',
                                $order
                            ) }}"
                            class="
                                inline-flex h-11
                                items-center justify-center
                                rounded-lg border
                                border-[#DDDCD7]
                                px-6 text-sm
                                font-semibold text-[#35433F]
                                transition
                                hover:bg-[#F7F6F2]
                            "
                        >
                            Ver pedido
                        </a>

                        <div
                            class="
                                flex flex-col gap-3
                                sm:flex-row
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
                                    transition
                                    hover:bg-[#F7F6F2]
                                "
                            >
                                Continuar comprando
                            </a>

                            <a
                                href="{{ route('store.checkout.payment', $order) }}"
                                class="
                                    inline-flex h-11
                                    items-center justify-center
                                    gap-2 rounded-lg
                                    bg-[#062B25]
                                    px-6 text-sm
                                    font-semibold text-white
                                    transition
                                    hover:bg-[#0B3C34]
                                "
                            >
                                Ir para pagamento

                                <x-heroicon-o-arrow-right
                                    class="h-4 w-4"
                                />
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
