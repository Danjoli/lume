<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Destinatário

    </h2>

    <dl class="space-y-4">

        <div>

            <dt>Nome</dt>

            <dd>

                {{ $shipment->order->user->name }}

            </dd>

        </div>

        <div>

            <dt>E-mail</dt>

            <dd>

                {{ $shipment->order->user->email }}

            </dd>

        </div>

        <div>

            <dt>Telefone</dt>

            <dd>

                {{ $shipment->order->user->phone }}

            </dd>

        </div>

    </dl>

</x-admin.cards.card>
