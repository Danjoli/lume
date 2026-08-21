        {{-- Estatísticas --}}
        <div
            class="
                grid gap-4
                sm:grid-cols-2
                xl:grid-cols-3
            "
        >

            <div
                class="
                    rounded-2xl border
                    border-[#E7E1DF]
                    bg-white p-6
                "
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p
                            class="
                                text-xs font-bold uppercase
                                tracking-[0.12em]
                                text-[#9B8D89]
                            "
                        >
                            Total de inscritos
                        </p>

                        <strong
                            class="
                                mt-2 block text-3xl
                                font-semibold text-[#2A211F]
                            "
                        >
                            {{ $stats['total'] }}
                        </strong>

                    </div>

                    <div
                        class="
                            flex h-11 w-11
                            items-center justify-center
                            rounded-xl bg-[#F8EFEF]
                            text-[#B85D70]
                        "
                    >
                        <x-heroicon-o-envelope class="h-5 w-5" />
                    </div>

                </div>

            </div>

            <div
                class="
                    rounded-2xl border
                    border-[#E7E1DF]
                    bg-white p-6
                "
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p
                            class="
                                text-xs font-bold uppercase
                                tracking-[0.12em]
                                text-[#9B8D89]
                            "
                        >
                            Ativos
                        </p>

                        <strong
                            class="
                                mt-2 block text-3xl
                                font-semibold text-[#2A211F]
                            "
                        >
                            {{ $stats['active'] }}
                        </strong>

                    </div>

                    <div
                        class="
                            flex h-11 w-11
                            items-center justify-center
                            rounded-xl bg-emerald-50
                            text-emerald-700
                        "
                    >
                        <x-heroicon-o-check-circle class="h-5 w-5" />
                    </div>

                </div>

            </div>

            <div
                class="
                    rounded-2xl border
                    border-[#E7E1DF]
                    bg-white p-6
                "
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p
                            class="
                                text-xs font-bold uppercase
                                tracking-[0.12em]
                                text-[#9B8D89]
                            "
                        >
                            Cancelados
                        </p>

                        <strong
                            class="
                                mt-2 block text-3xl
                                font-semibold text-[#2A211F]
                            "
                        >
                            {{ $stats['inactive'] }}
                        </strong>

                    </div>

                    <div
                        class="
                            flex h-11 w-11
                            items-center justify-center
                            rounded-xl bg-slate-100
                            text-slate-600
                        "
                    >
                        <x-heroicon-o-x-circle class="h-5 w-5" />
                    </div>

                </div>

            </div>

        </div>
