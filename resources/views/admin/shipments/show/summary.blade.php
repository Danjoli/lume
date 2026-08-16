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

                <x-badges.shipment-status-badge :status="$shipment->status" />

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

    </dl>

</x-admin.cards.card>
