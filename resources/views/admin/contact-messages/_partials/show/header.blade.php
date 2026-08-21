        {{-- Voltar --}}
        <a
            href="{{ route('admin.contact-messages.index') }}"
            class="
                inline-flex items-center gap-2
                text-sm font-semibold
                text-[#B85D70]
                transition
                hover:text-[#9F4C5E]
            "
        >
            <x-heroicon-o-arrow-left class="h-4 w-4" />

            Voltar para atendimentos
        </a>

        {{-- Cabeçalho --}}
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
                    Atendimento
                </p>

                <h1
                    class="
                        mt-2
                        font-['Cormorant_Garamond']
                        text-4xl font-semibold
                        text-[#2A211F]
                    "
                >
                    Mensagem #{{ $message->id }}
                </h1>

                <p class="mt-2 text-sm text-[#746B68]">
                    Recebida em
                    {{ $message->created_at->format('d/m/Y \à\s H:i') }}
                </p>

            </div>

            @php
                $status = match($message->status) {
                    'pending' => [
                        'label' => 'Pendente',
                        'class' => 'bg-amber-50 text-amber-700',
                    ],

                    'in_progress' => [
                        'label' => 'Em atendimento',
                        'class' => 'bg-blue-50 text-blue-700',
                    ],

                    'answered' => [
                        'label' => 'Respondido',
                        'class' => 'bg-emerald-50 text-emerald-700',
                    ],

                    'closed' => [
                        'label' => 'Encerrado',
                        'class' => 'bg-slate-100 text-slate-600',
                    ],

                    default => [
                        'label' => ucfirst($message->status),
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
