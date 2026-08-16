<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Endereço

    </h2>

    <address class="not-italic space-y-2">

        <p>

            {{ $order->address->street }},
            {{ $order->address->number }}

        </p>

        <p>

            {{ $order->address->district }}

        </p>

        <p>

            {{ $order->address->city }}
            /
            {{ $order->address->state }}

        </p>

        <p>

            CEP:
            {{ $order->address->zip_code }}

        </p>

    </address>

</x-admin.cards.card>
