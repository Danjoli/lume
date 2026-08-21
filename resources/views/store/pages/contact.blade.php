<x-store.app-layout title="Contato">

    <x-store.pages.hero eyebrow="Atendimento" title="Entre em contato" description="Tem alguma dúvida, sugestão ou precisa de ajuda com um pedido? Fale com a equipe da Lume." />

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
                        action="{{ route('store.pages.contact.store') }}"
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
                                value="{{ old('email', Auth::user()?->name) }}"
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
                                value="{{ old('email', Auth::user()?->email) }}"
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

                                <option
                                    value="order"
                                    @selected(old('subject') === 'order')
                                >
                                    Pedido
                                </option>

                                <option
                                    value="shipping"
                                    @selected(old('subject') === 'shipping')
                                >
                                    Entrega
                                </option>

                                <option
                                    value="payment"
                                    @selected(old('subject') === 'payment')
                                >
                                    Pagamento
                                </option>

                                <option
                                    value="exchange"
                                    @selected(old('subject') === 'exchange')
                                >
                                    Trocas e devoluções
                                </option>

                                <option
                                    value="product"
                                    @selected(old('subject') === 'product')
                                >
                                    Produto
                                </option>

                                <option
                                    value="account"
                                    @selected(old('subject') === 'account')
                                >
                                    Conta
                                </option>

                                <option
                                    value="other"
                                    @selected(old('subject') === 'other')
                                >
                                    Outros
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
