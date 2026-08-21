                    {{-- Envio --}}

                        @if($order->shipment)

                            <section
                                class="
                                    rounded-2xl border
                                    border-[#E5E3DE]
                                    bg-white p-6
                                "
                            >

                                <h2 class="text-lg font-bold text-[#17231F]">
                                    Entrega
                                </h2>

                                <dl
                                    class="
                                        mt-5 grid gap-5
                                        sm:grid-cols-2
                                    "
                                >

                                    <div>

                                        <dt class="text-xs text-[#69736F]">
                                            Transportadora
                                        </dt>

                                        <dd
                                            class="
                                                mt-1 text-sm
                                                font-medium text-[#17231F]
                                            "
                                        >
                                            {{ $order->shipment->carrier ?: '-' }}
                                        </dd>

                                    </div>

                                    <div>

                                        <dt class="text-xs text-[#69736F]">
                                            Código de rastreio
                                        </dt>

                                        <dd
                                            class="
                                                mt-1 text-sm
                                                font-medium text-[#17231F]
                                            "
                                        >
                                            {{ $order->shipment->tracking_code ?: '-' }}
                                        </dd>

                                    </div>

                                </dl>

                            </section>

                        @endif
