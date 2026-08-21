<x-store.app-layout :title="'Pagamento do pedido #' . $order->id">
    <section class="py-12 lg:py-16">
        <x-store.ui.container>
            <div class="mx-auto max-w-3xl rounded-2xl border border-[#E5E3DE] bg-white p-6 sm:p-8">
                <x-alerts.flash />
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-[#315249]">Pedido #{{ $order->id }}</p>
                        <h1 class="mt-2 text-3xl font-bold text-[#17231F]">Pagamento</h1>
                        <p class="mt-2 text-sm text-[#69736F]">Total: <strong>R$ {{ number_format($order->total, 2, ',', '.') }}</strong></p>
                    </div>
                    <x-badges.status-badge :status="$order->payment_status" />
                </div>

                @if($order->isPaid())
                    <div class="mt-8 rounded-xl bg-green-50 p-5 text-green-800">Pagamento confirmado. Seu pedido já está em processamento.</div>
                @elseif($order->gateway_error)
                    <div class="mt-8 rounded-xl border border-red-200 bg-red-50 p-5 text-sm text-red-700">
                        {{ $order->gateway_error }}
                        <form class="mt-4" method="POST" action="{{ route('store.checkout.payment.retry', $order) }}">@csrf
                            <button class="rounded-lg bg-[#062B25] px-5 py-2.5 font-semibold text-white">Tentar gerar novamente</button>
                        </form>
                    </div>
                @elseif($order->payment_method === \App\Enums\PaymentMethod::PIX && $order->pix_payload)
                    <div class="mt-8 text-center">
                        @if($order->pix_qr_code)<img class="mx-auto h-64 w-64" alt="QR Code PIX" src="data:image/png;base64,{{ $order->pix_qr_code }}">@endif
                        <p class="mt-4 text-sm text-[#69736F]">Escaneie o QR Code ou copie o código PIX:</p>
                        <textarea readonly class="mt-3 h-24 w-full rounded-lg border p-3 text-xs">{{ $order->pix_payload }}</textarea>
                    </div>
                @else
                    <div class="mt-8 rounded-xl bg-[#F7F6F2] p-5">
                        <p class="text-sm text-[#69736F]">A cobrança foi criada com segurança pelo Asaas.</p>
                        <a target="_blank" rel="noopener" href="{{ $order->bank_slip_url ?: $order->payment_url }}" class="mt-4 inline-flex rounded-lg bg-[#062B25] px-6 py-3 font-semibold text-white">
                            {{ $order->payment_method === \App\Enums\PaymentMethod::BOLETO ? 'Abrir boleto' : 'Pagar com cartão' }}
                        </a>
                    </div>
                @endif

                <div class="mt-8 flex flex-wrap gap-3 border-t pt-6">
                    <a class="rounded-lg border px-5 py-2.5 text-sm font-semibold" href="{{ route('store.customer.orders.show', $order) }}">Ver pedido</a>
                    <a class="rounded-lg border px-5 py-2.5 text-sm font-semibold" href="{{ route('store.checkout.payment', $order) }}">Atualizar status</a>
                </div>
            </div>
        </x-store.ui.container>
    </section>
</x-store.app-layout>
