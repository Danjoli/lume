            {{-- Mensagem --}}
            <div class="space-y-6">

                {{-- Dados do cliente --}}
                <section
                    class="
                        rounded-2xl border
                        border-[#E7E1DF]
                        bg-white p-6
                    "
                >

                    <h2 class="text-lg font-semibold text-[#2A211F]">
                        Cliente
                    </h2>

                    <div
                        class="
                            mt-5 grid gap-5
                            sm:grid-cols-2
                        "
                    >

                        <div>

                            <p
                                class="
                                    text-xs font-bold uppercase
                                    tracking-[0.12em]
                                    text-[#9B8D89]
                                "
                            >
                                Nome
                            </p>

                            <p class="mt-2 text-sm font-semibold text-[#2A211F]">
                                {{ $message->name }}
                            </p>

                        </div>

                        <div>

                            <p
                                class="
                                    text-xs font-bold uppercase
                                    tracking-[0.12em]
                                    text-[#9B8D89]
                                "
                            >
                                E-mail
                            </p>

                            <a
                                href="mailto:{{ $message->email }}"
                                class="
                                    mt-2 block text-sm
                                    font-semibold text-[#B85D70]
                                    hover:underline
                                "
                            >
                                {{ $message->email }}
                            </a>

                        </div>

                    </div>

                    @if($message->user)

                        <div
                            class="
                                mt-5 flex items-start gap-3
                                rounded-xl bg-[#FAF7F6]
                                p-4
                            "
                        >

                            <x-heroicon-o-user
                                class="
                                    mt-0.5 h-5 w-5
                                    shrink-0 text-[#B85D70]
                                "
                            />

                            <div>

                                <p class="text-sm font-semibold text-[#2A211F]">
                                    Cliente cadastrado
                                </p>

                                <p class="mt-1 text-xs text-[#857875]">
                                    Esta mensagem foi enviada por um usuário autenticado.
                                </p>

                            </div>

                        </div>

                    @endif

                </section>

                {{-- Conteúdo --}}
                <section
                    class="
                        rounded-2xl border
                        border-[#E7E1DF]
                        bg-white p-6
                    "
                >

                    <div>

                        <p
                            class="
                                text-xs font-bold uppercase
                                tracking-[0.12em]
                                text-[#9B8D89]
                            "
                        >
                            Assunto
                        </p>

                        <p class="mt-2 font-semibold text-[#2A211F]">
                            {{ ucfirst($message->subject) }}
                        </p>

                    </div>

                    <div class="my-6 border-t border-[#EEE9E7]"></div>

                    <div>

                        <p
                            class="
                                text-xs font-bold uppercase
                                tracking-[0.12em]
                                text-[#9B8D89]
                            "
                        >
                            Mensagem
                        </p>

                        <div
                            class="
                                mt-3 whitespace-pre-line
                                text-sm leading-7
                                text-[#5D514E]
                            "
                        >
                            {{ $message->message }}
                        </div>

                    </div>

                </section>

            </div>
