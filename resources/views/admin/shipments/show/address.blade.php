<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Endereço de Entrega

    </h2>

    <address class="space-y-2 not-italic">

        <p>

            {{ $shipment->order->street }},
            {{ $shipment->order->number }}

        </p>

        <p>

            {{ $shipment->order->neighborhood }}

        </p>

        <p>

            {{ $shipment->order->city }}
            /
            {{ $shipment->order->state }}

        </p>

        <p>

            CEP:
            {{ $shipment->order->cep }}

        </p>

    </address>

</x-admin.cards.card>
