                    {{-- Entrega --}}

                        <section
                            class="
                                rounded-2xl border
                                border-[#E5E3DE]
                                bg-white p-6
                            "
                        >

                            <h2 class="text-lg font-bold text-[#17231F]">
                                Endereço de entrega
                            </h2>

                            <div class="mt-5 text-sm leading-6 text-[#69736F]">

                                <p class="font-medium text-[#35433F]">
                                    {{ $order->recipient_name }}
                                </p>

                                <p class="mt-2">

                                    {{ $order->street }},
                                    {{ $order->number }}

                                    @if($order->complement)
                                        — {{ $order->complement }}
                                    @endif

                                </p>

                                <p>
                                    {{ $order->neighborhood }}
                                </p>

                                <p>
                                    {{ $order->city }}/{{ $order->state }}
                                </p>

                                <p>
                                    CEP {{ $order->cep }}
                                </p>

                                <p class="mt-2">
                                    {{ $order->phone }}
                                </p>

                            </div>

                        </section>
