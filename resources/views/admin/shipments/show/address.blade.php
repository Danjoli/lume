<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Endereço de Entrega

    </h2>

    <address class="space-y-2 not-italic">

        <p>

            {{ $shipment->order->address->street }},
            {{ $shipment->order->address->number }}

        </p>

        <p>

            {{ $shipment->order->address->district }}

        </p>

        <p>

            {{ $shipment->order->address->city }}
            /
            {{ $shipment->order->address->state }}

        </p>

        <p>

            CEP:
            {{ $shipment->order->address->zip_code }}

        </p>

    </address>

</x-admin.cards.card>
