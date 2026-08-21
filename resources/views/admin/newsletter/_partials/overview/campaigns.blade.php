        {{-- Campanhas --}}
        <section
            class="
                rounded-2xl border
                border-[#E7E1DF]
                bg-white
            "
        >

            <div
                class="
                    flex flex-col gap-4
                    border-b border-[#EEE9E7]
                    px-6 py-5
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                "
            >

                <div>

                    <h2 class="text-lg font-semibold text-[#2A211F]">
                        Campanhas
                    </h2>

                    <p class="mt-1 text-sm text-[#857875]">
                        Crie e acompanhe os envios da newsletter.
                    </p>

                </div>

                <a
                    href="{{ route('admin.newsletter.create') }}"
                    class="
                        text-sm font-semibold
                        text-[#B85D70]
                        transition
                        hover:text-[#9F4C5E]
                    "
                >
                    Criar campanha
                </a>

            </div>

            @if(isset($campaigns) && $campaigns->count())

                <div class="divide-y divide-[#EEE9E7]">

                    @foreach($campaigns as $campaign)

                        <div
                            class="
                                flex flex-col gap-4
                                px-6 py-5
                                sm:flex-row
                                sm:items-center
                                sm:justify-between
                            "
                        >

                            <div>

                                <div class="flex flex-wrap items-center gap-3">

                                    <h3 class="font-semibold text-[#2A211F]">
                                        {{ $campaign->title }}
                                    </h3>

                                    @php
                                        $campaignStatus = match($campaign->status) {
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
                                            inline-flex rounded-full
                                            px-3 py-1
                                            text-xs font-semibold
                                            {{ $campaignStatus['class'] }}
                                        "
                                    >
                                        {{ $campaignStatus['label'] }}
                                    </span>

                                </div>

                                <p class="mt-1 text-sm text-[#857875]">
                                    {{ $campaign->subject }}
                                </p>

                                @if($campaign->sent_at)

                                    <p class="mt-1 text-xs text-[#A29591]">
                                        Enviada em
                                        {{ $campaign->sent_at->format('d/m/Y H:i') }}
                                    </p>

                                @endif

                            </div>

                            <a
                                href="{{ route(
                                    'admin.newsletter.show',
                                    $campaign
                                ) }}"
                                class="
                                    inline-flex h-9
                                    items-center justify-center
                                    rounded-lg border
                                    border-[#E1D8D5]
                                    px-4 text-sm
                                    font-semibold text-[#6C5C58]
                                    transition
                                    hover:border-[#C96F82]
                                    hover:text-[#B85D70]
                                "
                            >
                                Ver campanha
                            </a>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="px-6 py-10 text-center">

                    <p class="text-sm text-[#857875]">
                        Nenhuma campanha criada até o momento.
                    </p>

                    <a
                        href="{{ route('admin.newsletter.create') }}"
                        class="
                            mt-4 inline-flex h-10
                            items-center justify-center
                            rounded-lg bg-[#B85D70]
                            px-5 text-sm
                            font-semibold text-white
                            transition
                            hover:bg-[#9F4C5E]
                        "
                    >
                        Criar primeira campanha
                    </a>

                </div>

            @endif

        </section>

    </div>
