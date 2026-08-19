<x-store.app-layout title="Sobre a Lume">

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
                    Institucional
                </span>

                <h1
                    class="
                        mt-5 text-4xl font-bold
                        tracking-[-0.035em] text-[#10211E]
                        lg:text-5xl
                    "
                >
                    Sobre a Lume
                </h1>

                <p
                    class="
                        mt-4 max-w-2xl
                        text-base leading-7 text-[#64706D]
                    "
                >
                    Livros que iluminam ideias, despertam novas perspectivas
                    e transformam conhecimento em novas possibilidades.
                </p>

            </div>

        </x-store.ui.container>

    </section>

    <section class="py-14 lg:py-20">

        <x-store.ui.container>

            <div
                class="
                    mx-auto grid max-w-5xl gap-12
                    lg:grid-cols-[1fr_0.8fr]
                "
            >

                <div>

                    <h2
                        class="
                            text-2xl font-bold
                            text-[#17231F]
                        "
                    >
                        Nossa história
                    </h2>

                    <div
                        class="
                            mt-5 space-y-5
                            text-base leading-7
                            text-[#64706D]
                        "
                    >

                        <p>
                            A Lume nasceu com a proposta de tornar a descoberta
                            de novos livros uma experiência simples, agradável
                            e inspiradora.
                        </p>

                        <p>
                            Acreditamos que cada livro pode abrir caminhos para
                            novas ideias, histórias e conhecimentos. Por isso,
                            buscamos reunir diferentes autores, gêneros e
                            perspectivas em um único lugar.
                        </p>

                        <p>
                            Mais do que uma livraria online, queremos criar um
                            espaço onde leitores possam encontrar sua próxima
                            grande leitura.
                        </p>

                    </div>

                </div>

                <div
                    class="
                        rounded-2xl
                        bg-[#F2F3EF]
                        p-8 lg:p-10
                    "
                >

                    <h2
                        class="
                            text-xl font-bold
                            text-[#17231F]
                        "
                    >
                        O que nos move
                    </h2>

                    <div class="mt-7 space-y-6">

                        <div class="flex gap-4">

                            <x-heroicon-o-book-open
                                class="
                                    h-6 w-6 shrink-0
                                    text-[#315249]
                                "
                            />

                            <div>

                                <h3 class="font-semibold text-[#17231F]">
                                    Conhecimento
                                </h3>

                                <p
                                    class="
                                        mt-1 text-sm leading-6
                                        text-[#69736F]
                                    "
                                >
                                    Aproximar pessoas de livros que ensinam,
                                    inspiram e transformam.
                                </p>

                            </div>

                        </div>

                        <div class="flex gap-4">

                            <x-heroicon-o-sparkles
                                class="
                                    h-6 w-6 shrink-0
                                    text-[#315249]
                                "
                            />

                            <div>

                                <h3 class="font-semibold text-[#17231F]">
                                    Descoberta
                                </h3>

                                <p
                                    class="
                                        mt-1 text-sm leading-6
                                        text-[#69736F]
                                    "
                                >
                                    Facilitar o encontro entre leitores,
                                    autores e novas histórias.
                                </p>

                            </div>

                        </div>

                        <div class="flex gap-4">

                            <x-heroicon-o-heart
                                class="
                                    h-6 w-6 shrink-0
                                    text-[#315249]
                                "
                            />

                            <div>

                                <h3 class="font-semibold text-[#17231F]">
                                    Experiência
                                </h3>

                                <p
                                    class="
                                        mt-1 text-sm leading-6
                                        text-[#69736F]
                                    "
                                >
                                    Oferecer uma experiência de compra
                                    simples, segura e agradável.
                                </p>

                            </div>

                        </div>

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

                <h2
                    class="
                        text-2xl font-bold
                        text-[#17231F]
                    "
                >
                    Encontre sua próxima leitura
                </h2>

                <p
                    class="
                        mx-auto mt-3 max-w-xl
                        text-sm leading-6 text-[#69736F]
                    "
                >
                    Explore nosso catálogo e descubra histórias,
                    conhecimentos e ideias para acompanhar você.
                </p>

                <a
                    href="{{ route('store.catalog.index') }}"
                    class="
                        mt-6 inline-flex h-11
                        items-center justify-center
                        rounded-lg bg-[#062B25]
                        px-6 text-sm font-semibold
                        text-white transition
                        hover:bg-[#0B3C34]
                    "
                >
                    Explorar livros
                </a>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
