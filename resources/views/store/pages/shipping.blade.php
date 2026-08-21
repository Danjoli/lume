<x-store.app-layout title="Entregas">

    <x-store.pages.hero eyebrow="Atendimento" title="Entregas" description="Saiba como funcionam os prazos, o acompanhamento e o recebimento dos seus pedidos na Lume." />

    <section class="py-14 lg:py-20">

        <x-store.ui.container>

            <div class="mx-auto max-w-5xl">

                <div class="grid gap-4 md:grid-cols-3">

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
                            <x-heroicon-o-clock class="h-6 w-6" />
                        </div>

                        <h2 class="mt-5 text-lg font-bold text-[#17231F]">
                            Prazo de entrega
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-[#69736F]">
                            O prazo é calculado de acordo com o CEP informado,
                            a modalidade de envio escolhida e a disponibilidade
                            dos produtos.
                        </p>

                    </div>

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
                            <x-heroicon-o-truck class="h-6 w-6" />
                        </div>

                        <h2 class="mt-5 text-lg font-bold text-[#17231F]">
                            Acompanhamento
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-[#69736F]">
                            Depois que o pedido for enviado, você poderá
                            acompanhar o andamento da entrega através das
                            informações disponibilizadas no seu pedido.
                        </p>

                    </div>

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
                            <x-heroicon-o-map-pin class="h-6 w-6" />
                        </div>

                        <h2 class="mt-5 text-lg font-bold text-[#17231F]">
                            Endereço
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-[#69736F]">
                            Confira atentamente o endereço informado antes de
                            finalizar a compra para evitar atrasos ou problemas
                            na entrega.
                        </p>

                    </div>

                </div>

                <div
                    class="
                        mt-10 grid gap-10
                        lg:grid-cols-[1.1fr_0.9fr]
                    "
                >

                    <div>

                        <h2 class="text-2xl font-bold text-[#17231F]">
                            Como funciona a entrega
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
                                        Confirmação do pedido
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        Após a confirmação do pagamento,
                                        iniciamos a preparação do seu pedido.
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
                                        Preparação e envio
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        Os livros são separados, embalados e
                                        preparados para envio.
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
                                        Transporte
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        Após a postagem, o pedido segue para
                                        transporte até o endereço informado.
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
                                    4
                                </span>

                                <div>

                                    <h3 class="font-semibold text-[#17231F]">
                                        Entrega
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        O pedido é entregue no endereço
                                        cadastrado durante a compra.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div
                        class="
                            h-fit rounded-2xl
                            bg-[#F2F3EF] p-8
                        "
                    >

                        <h2 class="text-xl font-bold text-[#17231F]">
                            Informações importantes
                        </h2>

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
                                    O prazo informado começa a contar após a
                                    confirmação do pagamento.
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
                                    Finais de semana e feriados podem não ser
                                    considerados dias úteis no cálculo.
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
                                    É importante que haja alguém disponível
                                    para receber o pedido no endereço informado.
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
                                    Em caso de problema com a entrega, entre
                                    em contato com nosso atendimento.
                                </span>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </x-store.ui.container>

    </section>

    <x-store.pages.cta title="Precisa de ajuda com uma entrega?" description="Se você tiver alguma dúvida sobre o andamento do seu pedido, entre em contato com a equipe da Lume." :href="route('store.pages.contact')" label="Entrar em contato" />

</x-store.app-layout>
