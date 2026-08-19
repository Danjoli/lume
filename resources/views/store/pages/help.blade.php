<x-store.app-layout title="Central de ajuda">

    <section class="border-b border-[#ECEAE6] py-14 lg:py-16">

        <x-store.ui.container>

            <div class="mx-auto max-w-5xl">

                <span
                    class="
                        inline-flex rounded-full
                        bg-[#EDF0EC] px-4 py-1.5
                        text-xs font-semibold text-[#233A35]
                    "
                >
                    Atendimento
                </span>

                <h1
                    class="
                        mt-5 text-4xl font-bold
                        tracking-[-0.035em] text-[#10211E]
                        lg:text-5xl
                    "
                >
                    Central de ajuda
                </h1>

                <p
                    class="
                        mt-4 max-w-2xl
                        text-base leading-7 text-[#64706D]
                    "
                >
                    Encontre respostas rápidas sobre compras, entregas,
                    pagamentos, trocas e outros assuntos relacionados à Lume.
                </p>

            </div>

        </x-store.ui.container>

    </section>

    <section class="py-14 lg:py-20">

        <x-store.ui.container>

            <div class="mx-auto max-w-5xl">

                <div class="grid gap-4 md:grid-cols-2">

                    <a
                        href="{{ route('store.pages.shipping') }}"
                        class="
                            group rounded-2xl border border-[#E5E3DE]
                            bg-white p-6 transition
                            hover:border-[#BFCAC6]
                            hover:shadow-sm
                        "
                    >

                        <div
                            class="
                                flex h-12 w-12 items-center justify-center
                                rounded-xl bg-[#EDF0EC]
                                text-[#315249]
                            "
                        >
                            <x-heroicon-o-truck class="h-6 w-6" />
                        </div>

                        <div class="mt-5 flex items-start justify-between gap-4">

                            <div>

                                <h2
                                    class="
                                        text-lg font-bold text-[#17231F]
                                        transition group-hover:text-[#0D5147]
                                    "
                                >
                                    Entregas
                                </h2>

                                <p
                                    class="
                                        mt-2 text-sm leading-6
                                        text-[#69736F]
                                    "
                                >
                                    Consulte informações sobre prazos,
                                    acompanhamento e recebimento dos pedidos.
                                </p>

                            </div>

                            <x-heroicon-o-chevron-right
                                class="
                                    mt-1 h-5 w-5 shrink-0
                                    text-[#8A918E]
                                    transition
                                    group-hover:translate-x-1
                                    group-hover:text-[#0D5147]
                                "
                            />

                        </div>

                    </a>

                    <a
                        href="{{ route('store.pages.returns') }}"
                        class="
                            group rounded-2xl border border-[#E5E3DE]
                            bg-white p-6 transition
                            hover:border-[#BFCAC6]
                            hover:shadow-sm
                        "
                    >

                        <div
                            class="
                                flex h-12 w-12 items-center justify-center
                                rounded-xl bg-[#EDF0EC]
                                text-[#315249]
                            "
                        >
                            <x-heroicon-o-arrow-path class="h-6 w-6" />
                        </div>

                        <div class="mt-5 flex items-start justify-between gap-4">

                            <div>

                                <h2
                                    class="
                                        text-lg font-bold text-[#17231F]
                                        transition group-hover:text-[#0D5147]
                                    "
                                >
                                    Trocas e devoluções
                                </h2>

                                <p
                                    class="
                                        mt-2 text-sm leading-6
                                        text-[#69736F]
                                    "
                                >
                                    Saiba como solicitar uma troca ou devolução
                                    e quais são as condições aplicáveis.
                                </p>

                            </div>

                            <x-heroicon-o-chevron-right
                                class="
                                    mt-1 h-5 w-5 shrink-0
                                    text-[#8A918E]
                                    transition
                                    group-hover:translate-x-1
                                    group-hover:text-[#0D5147]
                                "
                            />

                        </div>

                    </a>

                    <a
                        href="{{ route('store.pages.payments') }}"
                        class="
                            group rounded-2xl border border-[#E5E3DE]
                            bg-white p-6 transition
                            hover:border-[#BFCAC6]
                            hover:shadow-sm
                        "
                    >

                        <div
                            class="
                                flex h-12 w-12 items-center justify-center
                                rounded-xl bg-[#EDF0EC]
                                text-[#315249]
                            "
                        >
                            <x-heroicon-o-credit-card class="h-6 w-6" />
                        </div>

                        <div class="mt-5 flex items-start justify-between gap-4">

                            <div>

                                <h2
                                    class="
                                        text-lg font-bold text-[#17231F]
                                        transition group-hover:text-[#0D5147]
                                    "
                                >
                                    Formas de pagamento
                                </h2>

                                <p
                                    class="
                                        mt-2 text-sm leading-6
                                        text-[#69736F]
                                    "
                                >
                                    Confira as formas de pagamento disponíveis
                                    e informações sobre aprovação e segurança.
                                </p>

                            </div>

                            <x-heroicon-o-chevron-right
                                class="
                                    mt-1 h-5 w-5 shrink-0
                                    text-[#8A918E]
                                    transition
                                    group-hover:translate-x-1
                                    group-hover:text-[#0D5147]
                                "
                            />

                        </div>

                    </a>

                    <a
                        href="{{ route('store.pages.contact') }}"
                        class="
                            group rounded-2xl border border-[#E5E3DE]
                            bg-white p-6 transition
                            hover:border-[#BFCAC6]
                            hover:shadow-sm
                        "
                    >

                        <div
                            class="
                                flex h-12 w-12 items-center justify-center
                                rounded-xl bg-[#EDF0EC]
                                text-[#315249]
                            "
                        >
                            <x-heroicon-o-chat-bubble-left-right class="h-6 w-6" />
                        </div>

                        <div class="mt-5 flex items-start justify-between gap-4">

                            <div>

                                <h2
                                    class="
                                        text-lg font-bold text-[#17231F]
                                        transition group-hover:text-[#0D5147]
                                    "
                                >
                                    Fale conosco
                                </h2>

                                <p
                                    class="
                                        mt-2 text-sm leading-6
                                        text-[#69736F]
                                    "
                                >
                                    Não encontrou o que precisava?
                                    Entre em contato com nossa equipe.
                                </p>

                            </div>

                            <x-heroicon-o-chevron-right
                                class="
                                    mt-1 h-5 w-5 shrink-0
                                    text-[#8A918E]
                                    transition
                                    group-hover:translate-x-1
                                    group-hover:text-[#0D5147]
                                "
                            />

                        </div>

                    </a>

                </div>

            </div>

        </x-store.ui.container>

    </section>

    <section
        class="
            border-t border-[#ECEAE6]
            bg-[#F7F6F2] py-14
        "
    >

        <x-store.ui.container>

            <div class="mx-auto max-w-3xl text-center">

                <h2 class="text-2xl font-bold text-[#17231F]">
                    Ainda precisa de ajuda?
                </h2>

                <p
                    class="
                        mx-auto mt-3 max-w-xl
                        text-sm leading-6 text-[#69736F]
                    "
                >
                    Nossa equipe está disponível para ajudar com dúvidas
                    relacionadas à sua compra ou experiência na Lume.
                </p>

                <a
                    href="{{ route('store.pages.contact') }}"
                    class="
                        mt-6 inline-flex h-11
                        items-center justify-center
                        rounded-lg bg-[#062B25]
                        px-6 text-sm font-semibold
                        text-white transition
                        hover:bg-[#0B3C34]
                    "
                >
                    Entrar em contato
                </a>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>

