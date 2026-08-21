<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Envio

    </h2>

    <dl class="space-y-4">

        <div>

            <dt>Status</dt>

            <dd>

                <x-badges.status-badge :status="$order->shipment_status" />

            </dd>

        </div>

        <div>

            <dt>Transportadora</dt>

            <dd>

                {{ $order->shipment?->carrier }}

            </dd>

        </div>

        <div>

            <dt>Rastreamento</dt>

            <dd>

                {{ $order->shipment?->tracking_code }}

            </dd>

        </div>

    </dl>

</x-admin.cards.card>
