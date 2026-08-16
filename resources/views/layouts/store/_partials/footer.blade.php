<footer class="bg-[#062B25] text-white">

    <x-store.ui.container>

        <div
            class="
                grid gap-10 py-14
                md:grid-cols-2
                lg:grid-cols-4
            "
        >

            {{-- Marca --}}

            <div>

                <a
                    href="{{ route('store.home') }}"
                    class="inline-block"
                >

                    <span
                        class="
                            text-3xl font-light
                            tracking-[0.30em]
                        "
                    >
                        LUME
                    </span>

                </a>

                <p
                    class="
                        mt-2 text-xs
                        text-white/60
                    "
                >
                    Livros que iluminam ideias
                </p>

                <p
                    class="
                        mt-5 max-w-[280px]
                        text-sm leading-6
                        text-white/65
                    "
                >
                    Histórias, conhecimento e novas ideias
                    para acompanhar você em cada página.
                </p>

            </div>

            {{-- Institucional --}}

            <div>

                <h3 class="text-sm font-semibold">
                    Institucional
                </h3>

                <ul class="mt-5 space-y-3 text-sm text-white/65">

                    <li>
                        <a href="#" class="hover:text-white">
                            Sobre a Lume
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-white">
                            Contato
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-white">
                            Política de privacidade
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-white">
                            Termos de uso
                        </a>
                    </li>

                </ul>

            </div>

            {{-- Atendimento --}}

            <div>

                <h3 class="text-sm font-semibold">
                    Atendimento
                </h3>

                <ul class="mt-5 space-y-3 text-sm text-white/65">

                    <li>
                        <a href="#" class="hover:text-white">
                            Central de ajuda
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-white">
                            Entregas
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-white">
                            Trocas e devoluções
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-white">
                            Formas de pagamento
                        </a>
                    </li>

                </ul>

            </div>

            {{-- Newsletter --}}

            <div>

                <h3 class="text-sm font-semibold">
                    Receba novidades
                </h3>

                <p
                    class="
                        mt-5 text-sm leading-6
                        text-white/65
                    "
                >
                    Novos livros, promoções e recomendações
                    diretamente no seu e-mail.
                </p>

                <form class="mt-5">

                    <div class="flex">

                        <input
                            type="email"
                            placeholder="Seu e-mail"
                            class="
                                min-w-0 flex-1
                                rounded-l-lg border
                                border-white/20
                                bg-white/10
                                px-4 py-3
                                text-sm text-white
                                outline-none
                                placeholder:text-white/40
                                focus:border-white/40
                            "
                        >

                        <button
                            type="submit"
                            class="
                                rounded-r-lg
                                bg-white px-4
                                text-[#062B25]
                                transition
                                hover:bg-[#F0EFEA]
                            "
                        >
                            <x-heroicon-o-arrow-right
                                class="h-5 w-5"
                            />
                        </button>

                    </div>

                </form>

            </div>

        </div>

        <div
            class="
                flex flex-col gap-4
                border-t border-white/10
                py-6
                text-xs text-white/50
                sm:flex-row
                sm:items-center
                sm:justify-between
            "
        >

            <p>
                © {{ date('Y') }} Lume. Todos os direitos reservados.
            </p>

            <div class="flex items-center gap-5">

                <span>
                    Compra segura
                </span>

                <span>
                    Pagamento protegido
                </span>

            </div>

        </div>

    </x-store.ui.container>

</footer>
