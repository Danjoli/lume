                {{-- Resumo --}}

                    <aside
                        class="
                            h-fit rounded-2xl
                            border border-[#E5E3DE]
                            bg-white p-6
                        "
                    >

                        <h2 class="text-lg font-bold text-[#17231F]">
                            Resumo
                        </h2>

                        <dl class="mt-6 space-y-4">

                            <div class="flex justify-between text-sm">

                                <dt class="text-[#69736F]">
                                    Subtotal
                                </dt>

                                <dd class="font-medium text-[#17231F]">

                                    R$
                                    {{ number_format(
                                        $order->subtotal,
                                        2,
                                        ',',
                                        '.'
                                    ) }}

                                </dd>

</div>
                            <div class="flex justify-between text-sm">

                                <dt class="text-[#69736F]">
                                    Frete
                                </dt>

                                <dd class="font-medium text-[#17231F]">

                                    R$
                                    {{ number_format(
                                        $order->shipping,
                                        2,
                                        ',',
                                        '.'
                                    ) }}

                                </dd>

                            </div>

                            <div class="flex justify-between text-sm">

                                <dt class="text-[#69736F]">
                                    Desconto
                                </dt>

                                <dd class="font-medium text-[#17231F]">

                                    - R$
                                    {{ number_format(
                                        $order->discount,
                                        2,
                                        ',',
                                        '.'
                                    ) }}

                                </dd>

                            </div>

                            <div
                                class="
                                    flex justify-between
                                    border-t border-[#ECEAE6]
                                    pt-5
                                "
                            >

                                <dt class="font-semibold text-[#17231F]">
                                    Total
                                </dt>

                                <dd
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >

                                    R$
                                    {{ number_format(
                                        $order->total,
                                        2,
                                        ',',
                                        '.'
                                    ) }}

                                </dd>

                            </div>

                        </dl>

                        <div
                            class="
                                mt-6 border-t
                                border-[#ECEAE6]
                                pt-5
                            "
                        >

                            <p class="text-xs text-[#69736F]">
                                Status do pagamento
                            </p>

                            <div class="mt-2">

                                <x-badges.status-badge
                                    :status="$order->payment_status"
                                />

                            </div>

                            @if($order->isPaymentPending())
                                <a href="{{ route('store.checkout.payment', $order) }}" class="mt-4 inline-flex rounded-lg bg-[#062B25] px-4 py-2 text-sm font-semibold text-white">Pagar pedido</a>
                            @endif

                            @if($order->shipment)
                                <div class="mt-6 border-t border-[#ECEAE6] pt-5">
                                    <p class="text-xs text-[#69736F]">Envio</p>
                                    <p class="mt-2 text-sm font-semibold text-[#17231F]">{{ $order->shipment->carrier }} — {{ $order->shipment->status->label() }}</p>
                                    @if($order->shipment->tracking_code)
                                        <p class="mt-1 text-xs text-[#69736F]">Rastreio: {{ $order->shipment->tracking_code }}</p>
                                    @endif
                                    @if($order->shipment->tracking_url)
                                        <a target="_blank" rel="noopener" href="{{ $order->shipment->tracking_url }}" class="mt-3 inline-flex rounded-lg border px-4 py-2 text-xs font-semibold">Acompanhar entrega</a>
                                    @endif
                                </div>
                            @endif

                        </div>

                    </aside>
