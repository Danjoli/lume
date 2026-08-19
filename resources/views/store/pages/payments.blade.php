<x-store.app-layout title="Formas de pagamento">

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
                    Formas de pagamento
                </h1>

                <p
                    class="
                        mt-4 max-w-2xl
                        text-base leading-7 text-[#64706D]
                    "
                >
                    Confira as formas de pagamento disponíveis
                    e escolha a melhor opção para finalizar sua compra.
                </p>

            </div>

        </x-store.ui.container>

    </section>

    <section class="py-14 lg:py-20">

        <x-store.ui.container>

            <div class="mx-auto max-w-5xl">

                {{-- Formas de pagamento --}}
                <div class="grid gap-4 md:grid-cols-3">

                    {{-- PIX --}}
                    <div
                        class="
                            rounded-2xl border border-[#E5E3DE]
                            bg-white p-6
                        "
                    >

                        <div
                            class="
                                flex h-12 w-12 items-center justify-center
                                rounded-xl bg-[#EDF0EC]
                                text-[#315249]
                            "
                        >
                            <x-heroicon-o-qr-code class="h-6 w-6" />
                        </div>

                        <h2 class="mt-5 text-lg font-bold text-[#17231F]">
                            PIX
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-[#69736F]">
                            Pague utilizando o QR Code ou o código PIX
                            disponibilizado durante a finalização da compra.
                        </p>

                        <div
                            class="
                                mt-5 inline-flex items-center gap-2
                                rounded-full bg-[#EDF0EC]
                                px-3 py-1.5
                                text-xs font-semibold text-[#315249]
                            "
                        >
                            <x-heroicon-o-bolt class="h-4 w-4" />

                            Confirmação rápida
                        </div>

                    </div>

                    {{-- Cartão --}}
                    <div
                        class="
                            rounded-2xl border border-[#E5E3DE]
                            bg-white p-6
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

                        <h2 class="mt-5 text-lg font-bold text-[#17231F]">
                            Cartão de crédito
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-[#69736F]">
                            Faça sua compra com cartão de crédito de forma
                            prática e segura durante o checkout.
                        </p>

                        <div
                            class="
                                mt-5 inline-flex items-center gap-2
                                rounded-full bg-[#EDF0EC]
                                px-3 py-1.5
                                text-xs font-semibold text-[#315249]
                            "
                        >
                            <x-heroicon-o-calendar-days class="h-4 w-4" />

                            Até 6x sem juros
                        </div>

                    </div>

                    {{-- Boleto --}}
                    <div
                        class="
                            rounded-2xl border border-[#E5E3DE]
                            bg-white p-6
                        "
                    >

                        <div
                            class="
                                flex h-12 w-12 items-center justify-center
                                rounded-xl bg-[#EDF0EC]
                                text-[#315249]
                            "
                        >
                            <x-heroicon-o-document-text class="h-6 w-6" />
                        </div>

                        <h2 class="mt-5 text-lg font-bold text-[#17231F]">
                            Boleto bancário
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-[#69736F]">
                            Gere o boleto durante a compra e realize
                            o pagamento dentro do prazo indicado.
                        </p>

                        <div
                            class="
                                mt-5 inline-flex items-center gap-2
                                rounded-full bg-[#EDF0EC]
                                px-3 py-1.5
                                text-xs font-semibold text-[#315249]
                            "
                        >
                            <x-heroicon-o-clock class="h-4 w-4" />

                            Compensação bancária
                        </div>

                    </div>

                </div>

                {{-- Informações --}}
                <div
                    class="
                        mt-10 grid gap-10
                        lg:grid-cols-[1.1fr_0.9fr]
                    "
                >

                    <div>

                        <h2 class="text-2xl font-bold text-[#17231F]">
                            Como funciona o pagamento
                        </h2>

                        <div class="mt-6 space-y-7">

                            <div class="flex gap-4">

                                <span
                                    class="
                                        flex h-9 w-9 shrink-0
                                        items-center justify-center
                                        rounded-full bg-[#062B25]
                                        text-sm font-bold text-white
                                    "
                                >
                                    1
                                </span>

                                <div>

                                    <h3 class="font-semibold text-[#17231F]">
                                        Escolha seus livros
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        Adicione os livros desejados ao carrinho
                                        e avance para a finalização da compra.
                                    </p>

                                </div>

                            </div>

                            <div class="flex gap-4">

                                <span
                                    class="
                                        flex h-9 w-9 shrink-0
                                        items-center justify-center
                                        rounded-full bg-[#062B25]
                                        text-sm font-bold text-white
                                    "
                                >
                                    2
                                </span>

                                <div>

                                    <h3 class="font-semibold text-[#17231F]">
                                        Escolha a forma de pagamento
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        Durante o checkout, selecione uma das
                                        opções de pagamento disponíveis.
                                    </p>

                                </div>

                            </div>

                            <div class="flex gap-4">

                                <span
                                    class="
                                        flex h-9 w-9 shrink-0
                                        items-center justify-center
                                        rounded-full bg-[#062B25]
                                        text-sm font-bold text-white
                                    "
                                >
                                    3
                                </span>

                                <div>

                                    <h3 class="font-semibold text-[#17231F]">
                                        Confirmação
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        Após a confirmação do pagamento,
                                        seu pedido seguirá para preparação.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Segurança --}}
                    <div
                        class="
                            h-fit rounded-2xl
                            bg-[#F2F3EF] p-8
                        "
                    >

                        <div
                            class="
                                flex h-12 w-12 items-center justify-center
                                rounded-xl bg-white text-[#315249]
                            "
                        >
                            <x-heroicon-o-shield-check class="h-6 w-6" />
                        </div>

                        <h2 class="mt-5 text-xl font-bold text-[#17231F]">
                            Pagamento seguro
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-[#69736F]">
                            As informações de pagamento são processadas
                            de forma segura pelo provedor responsável
                            pela transação.
                        </p>

                        <ul
                            class="
                                mt-6 space-y-4
                                text-sm leading-6 text-[#69736F]
                            "
                        >

                            <li class="flex gap-3">

                                <x-heroicon-o-check-circle
                                    class="
                                        mt-0.5 h-5 w-5 shrink-0
                                        text-[#315249]
                                    "
                                />

                                <span>
                                    Ambiente protegido durante a compra.
                                </span>

                            </li>

                            <li class="flex gap-3">

                                <x-heroicon-o-check-circle
                                    class="
                                        mt-0.5 h-5 w-5 shrink-0
                                        text-[#315249]
                                    "
                                />

                                <span>
                                    Confirmação automática do pagamento
                                    quando disponível.
                                </span>

                            </li>

                            <li class="flex gap-3">

                                <x-heroicon-o-check-circle
                                    class="
                                        mt-0.5 h-5 w-5 shrink-0
                                        text-[#315249]
                                    "
                                />

                                <span>
                                    O pedido somente é preparado após
                                    a confirmação do pagamento.
                                </span>

                            </li>

                        </ul>

                    </div>

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
                    Ficou com alguma dúvida?
                </h2>

                <p
                    class="
                        mx-auto mt-3 max-w-xl
                        text-sm leading-6 text-[#69736F]
                    "
                >
                    Entre em contato com nossa equipe caso precise
                    de ajuda com o pagamento do seu pedido.
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
