<section class="border-b border-[#ECEAE6]">

    <x-store.ui.container>

        <div
            class="
                grid overflow-hidden
                lg:grid-cols-[44%_56%]
            "
        >

            {{-- Conteúdo --}}
            <div
                class="
                    flex flex-col justify-center
                    py-12 pr-8 lg:min-h-[430px] lg:py-10
                "
            >

                <span
                    class="
                        mb-6 w-fit rounded-full
                        bg-[#EDF0EC] px-4 py-1.5
                        text-xs font-semibold text-[#233A35]
                    "
                >
                    Bem-vindo à Lume
                </span>

                <h1
                    class="
                        max-w-[560px]
                        text-4xl font-bold leading-[1.22]
                        tracking-[-0.035em]
                        text-[#10211E]
                        lg:text-[43px]
                    "
                >
                    Histórias que inspiram.
                    <br>
                    Conhecimento que transforma.
                </h1>

                <p
                    class="
                        mt-6 max-w-[520px]
                        text-base leading-7 text-[#64706D]
                    "
                >
                    Milhares de livros para você descobrir novos mundos,
                    aprender algo novo e encontrar sua próxima grande leitura.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">

                    <a
                        href="{{ route('store.catalog.index') }}"
                        class="
                            inline-flex h-12 items-center justify-center
                            rounded-lg bg-[#062B25]
                            px-7 text-sm font-semibold text-white
                            transition hover:bg-[#0B3C34]
                        "
                    >
                        Explorar livros
                    </a>

                    <a
                        href="#categorias"
                        class="
                            inline-flex h-12 items-center justify-center
                            rounded-lg border border-[#DDDCD7]
                            bg-white px-7 text-sm font-semibold
                            transition hover:bg-[#F7F6F2]
                        "
                    >
                        Ver categorias
                    </a>

                </div>

                <div
                    class="
                        mt-10 grid gap-6
                        sm:grid-cols-3
                    "
                >

                    <div class="flex items-center gap-3">

                        <x-heroicon-o-cube
                            class="h-7 w-7 shrink-0 text-[#263934]"
                        />

                        <div>
                            <strong class="block text-xs">
                                Entrega rápida
                            </strong>

                            <span class="text-xs text-[#69736F]">
                                Para todo o Brasil
                            </span>
                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        <x-heroicon-o-shield-check
                            class="h-7 w-7 shrink-0 text-[#263934]"
                        />

                        <div>
                            <strong class="block text-xs">
                                Compra segura
                            </strong>

                            <span class="text-xs text-[#69736F]">
                                Seus dados protegidos
                            </span>
                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        <x-heroicon-o-credit-card
                            class="h-7 w-7 shrink-0 text-[#263934]"
                        />

                        <div>
                            <strong class="block text-xs">
                                Parcelamento
                            </strong>

                            <span class="text-xs text-[#69736F]">
                                Em até 6x sem juros
                            </span>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Imagem --}}
            <div
                class="
                    relative hidden overflow-hidden
                    rounded-bl-[70px] lg:block
                "
            >

                <img
                    src="{{ asset('images/store/hero-lume.jpg') }}"
                    alt="Livros Lume"
                    class="h-full w-full object-cover"
                >

            </div>

        </div>

    </x-store.ui.container>

</section>
