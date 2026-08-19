<x-store.app-layout title="Contato">

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
                    Entre em contato
                </h1>

                <p
                    class="
                        mt-4 max-w-2xl
                        text-base leading-7 text-[#64706D]
                    "
                >
                    Tem alguma dúvida, sugestão ou precisa de ajuda com um pedido?
                    Fale com a equipe da Lume.
                </p>

            </div>

        </x-store.ui.container>

    </section>

    <section class="py-14 lg:py-20">

        <x-store.ui.container>

            <div
                class="
                    mx-auto grid max-w-5xl gap-10
                    lg:grid-cols-[0.8fr_1.2fr]
                "
            >

                {{-- Informações --}}
                <div>

                    <h2 class="text-2xl font-bold text-[#17231F]">
                        Como podemos ajudar?
                    </h2>

                    <p class="mt-4 text-sm leading-6 text-[#69736F]">
                        Nossa equipe está disponível para ajudar com dúvidas sobre
                        pedidos, entregas, trocas, pagamentos e demais informações
                        sobre a Lume.
                    </p>

                    <div class="mt-8 space-y-6">

                        <div class="flex gap-4">

                            <div
                                class="
                                    flex h-11 w-11 shrink-0 items-center justify-center
                                    rounded-xl bg-[#EDF0EC]
                                    text-[#315249]
                                "
                            >
                                <x-heroicon-o-envelope class="h-5 w-5" />
                            </div>

                            <div>

                                <h3 class="font-semibold text-[#17231F]">
                                    E-mail
                                </h3>

                                <p class="mt-1 text-sm text-[#69736F]">
                                    contato@lume.com.br
                                </p>

                            </div>

                        </div>

                        <div class="flex gap-4">

                            <div
                                class="
                                    flex h-11 w-11 shrink-0 items-center justify-center
                                    rounded-xl bg-[#EDF0EC]
                                    text-[#315249]
                                "
                            >
                                <x-heroicon-o-clock class="h-5 w-5" />
                            </div>

                            <div>

                                <h3 class="font-semibold text-[#17231F]">
                                    Horário de atendimento
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                    Segunda a sexta-feira, das 9h às 18h.
                                </p>

                            </div>

                        </div>

                        <div class="flex gap-4">

                            <div
                                class="
                                    flex h-11 w-11 shrink-0 items-center justify-center
                                    rounded-xl bg-[#EDF0EC]
                                    text-[#315249]
                                "
                            >
                                <x-heroicon-o-chat-bubble-left-right class="h-5 w-5" />
                            </div>

                            <div>

                                <h3 class="font-semibold text-[#17231F]">
                                    Atendimento
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                    Respondemos normalmente em até 1 dia útil.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Formulário --}}
                <div
                    class="
                        rounded-2xl border border-[#E5E3DE]
                        bg-white p-6 lg:p-8
                    "
                >

                    <h2 class="text-xl font-bold text-[#17231F]">
                        Envie uma mensagem
                    </h2>

                    <p class="mt-2 text-sm text-[#69736F]">
                        Preencha os campos abaixo e entraremos em contato.
                    </p>

                    <form
                        action="#"
                        method="POST"
                        class="mt-8 space-y-5"
                    >
                        @csrf

                        <div>

                            <label
                                for="name"
                                class="mb-2 block text-sm font-medium text-[#17231F]"
                            >
                                Nome
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Seu nome"
                                class="
                                    h-11 w-full rounded-lg
                                    border border-[#DDDCD7]
                                    bg-white px-4 text-sm
                                    outline-none
                                    focus:border-[#0D5147]
                                "
                            >

                        </div>

                        <div>

                            <label
                                for="email"
                                class="mb-2 block text-sm font-medium text-[#17231F]"
                            >
                                E-mail
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="seu@email.com"
                                class="
                                    h-11 w-full rounded-lg
                                    border border-[#DDDCD7]
                                    bg-white px-4 text-sm
                                    outline-none
                                    focus:border-[#0D5147]
                                "
                            >

                        </div>

                        <div>

                            <label
                                for="subject"
                                class="mb-2 block text-sm font-medium text-[#17231F]"
                            >
                                Assunto
                            </label>

                            <select
                                id="subject"
                                name="subject"
                                class="
                                    h-11 w-full rounded-lg
                                    border border-[#DDDCD7]
                                    bg-white px-4 text-sm
                                    outline-none
                                    focus:border-[#0D5147]
                                "
                            >
                                <option value="">
                                    Selecione um assunto
                                </option>

                                <option value="pedido">
                                    Pedido
                                </option>

                                <option value="entrega">
                                    Entrega
                                </option>

                                <option value="troca">
                                    Troca ou devolução
                                </option>

                                <option value="pagamento">
                                    Pagamento
                                </option>

                                <option value="outro">
                                    Outro
                                </option>
                            </select>

                        </div>

                        <div>

                            <label
                                for="message"
                                class="mb-2 block text-sm font-medium text-[#17231F]"
                            >
                                Mensagem
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                placeholder="Como podemos ajudar?"
                                class="
                                    w-full resize-none rounded-lg
                                    border border-[#DDDCD7]
                                    bg-white px-4 py-3 text-sm
                                    outline-none
                                    focus:border-[#0D5147]
                                "
                            >{{ old('message') }}</textarea>

                        </div>

                        <button
                            type="submit"
                            class="
                                inline-flex h-11 items-center justify-center
                                rounded-lg bg-[#062B25]
                                px-6 text-sm font-semibold
                                text-white transition
                                hover:bg-[#0B3C34]
                            "
                        >
                            Enviar mensagem
                        </button>

                    </form>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>

