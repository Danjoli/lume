        {{-- Inscritos --}}
        <section
            class="
                overflow-hidden rounded-2xl
                border border-[#E7E1DF]
                bg-white
            "
        >

            <div
                class="
                    flex flex-col gap-3
                    border-b border-[#EEE9E7]
                    px-6 py-5
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                "
            >

                <div>

                    <h2 class="text-lg font-semibold text-[#2A211F]">
                        Inscritos
                    </h2>

                    <p class="mt-1 text-sm text-[#857875]">
                        Pessoas cadastradas para receber comunicações da Lume.
                    </p>

                </div>

            </div>

            @if($subscribers->count())

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-[#EEE9E7]">

                        <thead class="bg-[#FAF7F6]">

                            <tr>

                                <th
                                    class="
                                        px-6 py-4 text-left
                                        text-xs font-bold uppercase
                                        tracking-[0.12em]
                                        text-[#8A7D79]
                                    "
                                >
                                    E-mail
                                </th>

                                <th
                                    class="
                                        px-6 py-4 text-left
                                        text-xs font-bold uppercase
                                        tracking-[0.12em]
                                        text-[#8A7D79]
                                    "
                                >
                                    Status
                                </th>

                                <th
                                    class="
                                        px-6 py-4 text-left
                                        text-xs font-bold uppercase
                                        tracking-[0.12em]
                                        text-[#8A7D79]
                                    "
                                >
                                    Inscrição
                                </th>

                                <th
                                    class="
                                        px-6 py-4 text-left
                                        text-xs font-bold uppercase
                                        tracking-[0.12em]
                                        text-[#8A7D79]
                                    "
                                >
                                    Cancelamento
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-[#F0ECEA]">

                            @foreach($subscribers as $subscriber)

                                <tr class="transition hover:bg-[#FCFAF9]">

                                    <td class="px-6 py-5">

                                        <p class="font-semibold text-[#2A211F]">
                                            {{ $subscriber->email }}
                                        </p>

                                    </td>

                                    <td class="px-6 py-5">

                                        @if($subscriber->is_active)

                                            <span
                                                class="
                                                    inline-flex rounded-full
                                                    bg-emerald-50
                                                    px-3 py-1
                                                    text-xs font-semibold
                                                    text-emerald-700
                                                "
                                            >
                                                Ativo
                                            </span>

                                        @else

                                            <span
                                                class="
                                                    inline-flex rounded-full
                                                    bg-slate-100
                                                    px-3 py-1
                                                    text-xs font-semibold
                                                    text-slate-600
                                                "
                                            >
                                                Cancelado
                                            </span>

                                        @endif

                                    </td>

                                    <td class="px-6 py-5">

                                        <p class="text-sm text-[#5D514E]">
                                            {{ $subscriber->subscribed_at?->format('d/m/Y H:i') ?? '—' }}
                                        </p>

                                    </td>

                                    <td class="px-6 py-5">

                                        <p class="text-sm text-[#5D514E]">
                                            {{ $subscriber->unsubscribed_at?->format('d/m/Y H:i') ?? '—' }}
                                        </p>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div
                    class="
                        border-t border-[#EEE9E7]
                        px-6 py-5
                    "
                >
                    {{ $subscribers->links() }}
                </div>

            @else

                <div
                    class="
                        flex min-h-[260px]
                        flex-col items-center
                        justify-center
                        p-8 text-center
                    "
                >

                    <div
                        class="
                            flex h-14 w-14
                            items-center justify-center
                            rounded-full bg-[#F8EFEF]
                            text-[#B85D70]
                        "
                    >
                        <x-heroicon-o-envelope class="h-7 w-7" />
                    </div>

                    <h3 class="mt-5 text-lg font-semibold text-[#2A211F]">
                        Nenhum inscrito
                    </h3>

                    <p
                        class="
                            mt-2 max-w-md
                            text-sm leading-6
                            text-[#857875]
                        "
                    >
                        Quando alguém se cadastrar pela newsletter da loja,
                        o e-mail aparecerá aqui.
                    </p>

                </div>

            @endif

        </section>
