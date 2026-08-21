<x-store.app-layout title="Preferências">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mx-auto max-w-5xl">

                {{-- Cabeçalho --}}
                <div class="mb-8">

                    <span
                        class="
                            inline-flex rounded-full
                            bg-[#EDF0EC] px-4 py-1.5
                            text-xs font-semibold text-[#233A35]
                        "
                    >
                        Minha conta
                    </span>

                    <h1
                        class="
                            mt-5 text-3xl font-bold
                            tracking-[-0.03em]
                            text-[#14221E]
                        "
                    >
                        Preferências
                    </h1>

                    <p class="mt-2 text-sm text-[#69736F]">
                        Gerencie suas preferências de comunicação com a Lume.
                    </p>

                </div>

                <x-alerts.flash />

                <div
                    class="
                        rounded-2xl border border-[#E5E3DE]
                        bg-white p-6
                        lg:p-8
                    "
                >

                    <div>

                        <h2 class="text-lg font-bold text-[#17231F]">
                            Comunicações
                        </h2>

                        <p class="mt-1 text-sm text-[#69736F]">
                            Escolha quais comunicações deseja receber.
                        </p>

                    </div>

                    <div class="my-6 border-t border-[#ECEAE6]"></div>

                    {{-- Newsletter --}}
                    <div
                        class="
                            flex flex-col gap-5
                            sm:flex-row
                            sm:items-center
                            sm:justify-between
                        "
                    >

                        <div class="flex items-start gap-4">

                            <div
                                class="
                                    flex h-11 w-11 shrink-0
                                    items-center justify-center
                                    rounded-xl bg-[#EDF0EC]
                                "
                            >
                                <x-heroicon-o-envelope
                                    class="h-5 w-5 text-[#315249]"
                                />
                            </div>

                            <div>

                                <div class="flex flex-wrap items-center gap-3">

                                    <h3 class="font-semibold text-[#17231F]">
                                        Newsletter da Lume
                                    </h3>

                                    @if($newsletterSubscriber?->is_active)

                                        <span
                                            class="
                                                rounded-full
                                                bg-emerald-50
                                                px-2.5 py-1
                                                text-xs font-semibold
                                                text-emerald-700
                                            "
                                        >
                                            Ativada
                                        </span>

                                    @else

                                        <span
                                            class="
                                                rounded-full
                                                bg-[#F2F1ED]
                                                px-2.5 py-1
                                                text-xs font-semibold
                                                text-[#69736F]
                                            "
                                        >
                                            Desativada
                                        </span>

                                    @endif

                                </div>

                                <p
                                    class="
                                        mt-2 max-w-xl
                                        text-sm leading-6
                                        text-[#69736F]
                                    "
                                >
                                    Receba novidades sobre livros,
                                    promoções e recomendações diretamente
                                    no seu e-mail.
                                </p>

                            </div>

                        </div>

                        <form
                            action="{{ route(
                                'store.customer.preferences.newsletter.update'
                            ) }}"
                            method="POST"
                            class="shrink-0"
                        >
                            @csrf
                            @method('PATCH')

                            @if($newsletterSubscriber?->is_active)

                                <button
                                    type="submit"
                                    class="
                                        inline-flex h-10
                                        items-center justify-center
                                        rounded-lg border
                                        border-[#DDDCD7]
                                        px-4 text-sm
                                        font-semibold text-[#35433F]
                                        transition
                                        hover:bg-[#F7F6F2]
                                    "
                                >
                                    Desativar
                                </button>

                            @else

                                <button
                                    type="submit"
                                    class="
                                        inline-flex h-10
                                        items-center justify-center
                                        rounded-lg bg-[#062B25]
                                        px-4 text-sm
                                        font-semibold text-white
                                        transition
                                        hover:bg-[#0B3C34]
                                    "
                                >
                                    Ativar
                                </button>

                            @endif

                        </form>

                    </div>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
