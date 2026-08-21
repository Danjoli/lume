<x-admin.app-layout title="Campanha">

    <div class="mx-auto max-w-5xl">

        <a
            href="{{ route('admin.newsletter.index') }}"
            class="
                inline-flex items-center gap-2
                text-sm font-semibold
                text-[#B85D70]
                transition
                hover:text-[#9F4C5E]
            "
        >
            <x-heroicon-o-arrow-left class="h-4 w-4" />

            Voltar para newsletter
        </a>

        <div
            class="
                mt-7 flex flex-col gap-5
                lg:flex-row
                lg:items-start
                lg:justify-between
            "
        >

            <div>

                <p
                    class="
                        text-xs font-bold uppercase
                        tracking-[0.18em]
                        text-[#C96F82]
                    "
                >
                    Newsletter
                </p>

                <h1
                    class="
                        mt-2
                        font-['Cormorant_Garamond']
                        text-4xl font-semibold
                        text-[#2A211F]
                    "
                >
                    {{ $campaign->title }}
                </h1>

                <p class="mt-2 text-sm text-[#746B68]">
                    Criada em
                    {{ $campaign->created_at->format('d/m/Y \à\s H:i') }}
                </p>

            </div>

            @php
                $status = match($campaign->status) {
                    'draft' => [
                        'label' => 'Rascunho',
                        'class' => 'bg-amber-50 text-amber-700',
                    ],

                    'sending' => [
                        'label' => 'Enviando',
                        'class' => 'bg-blue-50 text-blue-700',
                    ],

                    'sent' => [
                        'label' => 'Enviada',
                        'class' => 'bg-emerald-50 text-emerald-700',
                    ],

                    default => [
                        'label' => ucfirst($campaign->status),
                        'class' => 'bg-slate-100 text-slate-600',
                    ],
                };
            @endphp

            <span
                class="
                    inline-flex w-fit rounded-full
                    px-3 py-1.5
                    text-xs font-semibold
                    {{ $status['class'] }}
                "
            >
                {{ $status['label'] }}
            </span>

        </div>

        <x-alerts.flash />

        <div
            class="
                mt-8 grid gap-6
                lg:grid-cols-[minmax(0,1fr)_320px]
            "
        >

            {{-- Conteúdo --}}
            <div class="space-y-6">

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
                            Assunto do e-mail
                        </p>

                        <p class="mt-2 font-semibold text-[#2A211F]">
                            {{ $campaign->subject }}
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
                            Conteúdo
                        </p>

                        <div
                            class="
                                mt-3 whitespace-pre-line
                                text-sm leading-7
                                text-[#5D514E]
                            "
                        >
                            {{ $campaign->content }}
                        </div>

                    </div>

                </section>

                {{-- Prévia --}}
                <section
                    class="
                        rounded-2xl border
                        border-[#E7E1DF]
                        bg-white p-6
                    "
                >

                    <h2 class="text-lg font-semibold text-[#2A211F]">
                        Prévia do e-mail
                    </h2>

                    <p class="mt-1 text-sm text-[#857875]">
                        Visualização aproximada do conteúdo que será enviado.
                    </p>

                    <div
                        class="
                            mt-6 overflow-hidden
                            rounded-xl border
                            border-[#E7E1DF]
                        "
                    >

                        <div
                            class="
                                bg-[#062B25]
                                px-6 py-5
                                text-white
                            "
                        >

                            <span
                                class="
                                    text-xl font-light
                                    tracking-[0.30em]
                                "
                            >
                                LUME
                            </span>

                            <p class="mt-1 text-xs text-white/60">
                                Livros que iluminam ideias
                            </p>

                        </div>

                        <div class="p-6">

                            <h3
                                class="
                                    text-2xl font-bold
                                    text-[#17231F]
                                "
                            >
                                {{ $campaign->title }}
                            </h3>

                            <div
                                class="
                                    mt-4 whitespace-pre-line
                                    text-sm leading-7
                                    text-[#69736F]
                                "
                            >
                                {{ $campaign->content }}
                            </div>

                            <a
                                href="{{ route('store.home') }}"
                                class="
                                    mt-6 inline-flex h-11
                                    items-center justify-center
                                    rounded-lg bg-[#062B25]
                                    px-5 text-sm
                                    font-semibold text-white
                                "
                            >
                                Visitar a Lume
                            </a>

                        </div>

                    </div>

                </section>

            </div>

            {{-- Lateral --}}
            <aside class="space-y-6">

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
                                Status
                            </dt>

                            <dd class="mt-1">

                                <span
                                    class="
                                        inline-flex rounded-full
                                        px-3 py-1
                                        text-xs font-semibold
                                        {{ $status['class'] }}
                                    "
                                >
                                    {{ $status['label'] }}
                                </span>

                            </dd>

                        </div>

                        <div>

                            <dt class="text-xs text-[#9B8D89]">
                                Criada em
                            </dt>

                            <dd class="mt-1 text-sm text-[#5D514E]">
                                {{ $campaign->created_at->format('d/m/Y H:i') }}
                            </dd>

                        </div>

                        @if($campaign->sent_at)

                            <div>

                                <dt class="text-xs text-[#9B8D89]">
                                    Enviada em
                                </dt>

                                <dd class="mt-1 text-sm text-[#5D514E]">
                                    {{ $campaign->sent_at->format('d/m/Y H:i') }}
                                </dd>

                            </div>

                        @endif

                    </dl>

                </section>

                {{-- Ações --}}
                <section
                    class="
                        rounded-2xl border
                        border-[#E7E1DF]
                        bg-white p-6
                    "
                >

                    <h2 class="font-semibold text-[#2A211F]">
                        Ações
                    </h2>

                    <div class="mt-5 space-y-3">

                        @if($campaign->status === 'draft')

                            <a
                                href="{{ route(
                                    'admin.newsletter.edit',
                                    $campaign
                                ) }}"
                                class="
                                    inline-flex h-10 w-full
                                    items-center justify-center
                                    gap-2 rounded-lg
                                    border border-[#E1D8D5]
                                    px-4 text-sm
                                    font-semibold text-[#6C5C58]
                                    transition
                                    hover:bg-[#FAF7F6]
                                "
                            >
                                <x-heroicon-o-pencil-square
                                    class="h-4 w-4"
                                />

                                Editar campanha
                            </a>

                            <form
                                action="{{ route(
                                    'admin.newsletter.send',
                                    $campaign
                                ) }}"
                                method="POST"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="
                                        inline-flex h-10 w-full
                                        items-center justify-center
                                        gap-2 rounded-lg
                                        bg-[#B85D70]
                                        px-4 text-sm
                                        font-semibold text-white
                                        transition
                                        hover:bg-[#9F4C5E]
                                    "
                                >
                                    <x-heroicon-o-paper-airplane
                                        class="h-4 w-4"
                                    />

                                    Enviar campanha
                                </button>

                            </form>

                        @elseif($campaign->status === 'sending')

                            <div
                                class="
                                    rounded-xl bg-blue-50
                                    p-4 text-sm
                                    leading-6 text-blue-700
                                "
                            >
                                Esta campanha está sendo enviada
                                aos inscritos ativos.
                            </div>

                        @elseif($campaign->status === 'sent')

                            <div
                                class="
                                    rounded-xl bg-emerald-50
                                    p-4 text-sm
                                    leading-6 text-emerald-700
                                "
                            >
                                Esta campanha já foi enviada
                                e não pode mais ser editada.
                            </div>

                        @endif

                    </div>

                </section>

            </aside>

        </div>

    </div>

</x-admin.app-layout>
