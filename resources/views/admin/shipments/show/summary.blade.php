<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Resumo

    </h2>

    <dl class="grid gap-6 md:grid-cols-2">

        <div>

            <dt>Pedido</dt>

            <dd>

                #{{ $shipment->order->number }}

            </dd>

        </div>

        <div>

            <dt>Status</dt>

            <dd>

            <x-badges.status-badge :status="$shipment->status" />

            </dd>

        </div>

        <div>

            <dt>Transportadora</dt>

            <dd>

                {{ $shipment->carrier }}

            </dd>

        </div>

        <div>

            <dt>Criado em</dt>

            <dd>

                {{ $shipment->created_at->format('d/m/Y H:i') }}

            </dd>

        </div>

        <div>
            <dt>Serviço</dt>
            <dd>{{ $shipment->service ?: '-' }}</dd>
        </div>

        <div>
            <dt>Custo do frete</dt>
            <dd>R$ {{ number_format((float) $shipment->shipping_cost, 2, ',', '.') }}</dd>
        </div>

        <div>
            <dt>Prazo estimado</dt>
            <dd>{{ $shipment->delivery_min_days }} a {{ $shipment->delivery_max_days }} dias úteis</dd>
        </div>

        <div>
            <dt>Postado em</dt>
            <dd>{{ $shipment->shipped_at?->format('d/m/Y H:i') ?: '-' }}</dd>
        </div>

    </dl>

</x-admin.cards.card>
