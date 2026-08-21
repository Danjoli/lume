            {{-- Lateral --}}
            <aside class="space-y-6">

                {{-- Status --}}
                <section
                    class="
                        rounded-2xl border
                        border-[#E7E1DF]
                        bg-white p-6
                    "
                >

                    <h2 class="font-semibold text-[#2A211F]">
                        Status do atendimento
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-[#857875]">
                        Atualize o andamento desta solicitação.
                    </p>

                    <div class="mt-5">

                        <span
                            class="
                                inline-flex rounded-full
                                px-3 py-1.5
                                text-xs font-semibold
                                {{ $status['class'] }}
                            "
                        >
                            {{ $status['label'] }}
                        </span>

                    </div>

                    {{-- Formulário de status --}}
                    <form
                        action="{{ route(
                            'admin.contact-messages.update-status',
                            $message
                        ) }}"
                        method="POST"
                        class="mt-5 space-y-4"
                    >
                        @csrf
                        @method('PATCH')

                        <div>

                            <label
                                for="status"
                                class="
                                    mb-2 block text-sm
                                    font-semibold text-[#2A211F]
                                "
                            >
                                Alterar status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="
                                    h-11 w-full rounded-lg
                                    border border-[#E1D8D5]
                                    bg-white px-4 text-sm
                                    text-[#5D514E]
                                    outline-none
                                    focus:border-[#B85D70]
                                "
                            >

                                <option
                                    value="pending"
                                    @selected(
                                        old('status', $message->status)
                                            === 'pending'
                                    )
                                >
                                    Pendente
                                </option>

                                <option
                                    value="in_progress"
                                    @selected(
                                        old('status', $message->status)
                                            === 'in_progress'
                                    )
                                >
                                    Em atendimento
                                </option>

                                <option
                                    value="answered"
                                    @selected(
                                        old('status', $message->status)
                                            === 'answered'
                                    )
                                >
                                    Respondido
                                </option>

                                <option
                                    value="closed"
                                    @selected(
                                        old('status', $message->status)
                                            === 'closed'
                                    )
                                >
                                    Encerrado
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-2 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <button
                            type="submit"
                            class="
                                inline-flex h-10 w-full
                                items-center justify-center
                                rounded-lg bg-[#B85D70]
                                px-4 text-sm
                                font-semibold text-white
                                transition
                                hover:bg-[#9F4C5E]
                            "
                        >
                            Atualizar status
                        </button>

                    </form>

                </section>

                {{-- Responder --}}
                <section
                    class="
                        rounded-2xl border
                        border-[#E7E1DF]
                        bg-white p-6
                    "
                >

                    <div
                        class="
                            flex h-10 w-10
                            items-center justify-center
                            rounded-xl bg-[#F8EFEF]
                            text-[#B85D70]
                        "
                    >
                        <x-heroicon-o-envelope class="h-5 w-5" />
                    </div>

                    <h2 class="mt-4 font-semibold text-[#2A211F]">
                        Responder cliente
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-[#857875]">
                        Entre em contato diretamente pelo e-mail informado.
                    </p>

                    <a
                        href="mailto:{{ $message->email }}"
                        class="
                            mt-5 inline-flex h-10 w-full
                            items-center justify-center
                            rounded-lg bg-[#B85D70]
                            px-4 text-sm
                            font-semibold text-white
                            transition
                            hover:bg-[#9F4C5E]
                        "
                    >
                        Responder por e-mail
                    </a>

                </section>

                {{-- Informações --}}
                <section
                    class="
                        rounded-2xl border
                        border-[#E7E1DF]
                        bg-white p-6
                    "
                >

                    <h2 class="font-semibold text-[#2A211F]">
                        Informações
                    </h2>

                    <dl class="mt-5 space-y-4">

                        <div>

                            <dt class="text-xs text-[#9B8D89]">
                                ID
                            </dt>

                            <dd class="mt-1 text-sm font-semibold text-[#2A211F]">
                                #{{ $message->id }}
                            </dd>

                        </div>

                        <div>

                            <dt class="text-xs text-[#9B8D89]">
                                Recebida em
                            </dt>

                            <dd class="mt-1 text-sm text-[#5D514E]">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </dd>

                        </div>

                        @if($message->answered_at)

                            <div>

                                <dt class="text-xs text-[#9B8D89]">
                                    Respondida em
                                </dt>

                                <dd class="mt-1 text-sm text-[#5D514E]">
                                    {{ $message->answered_at->format('d/m/Y H:i') }}
                                </dd>

                            </div>

                        @endif

                    </dl>

                </section>

            </aside>
