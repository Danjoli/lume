<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Cliente

    </h2>

    <dl class="space-y-4">

        <div>

            <dt>Nome</dt>

            <dd>

                {{ $order->user->name }}

            </dd>

        </div>

        <div>

            <dt>E-mail</dt>

            <dd>

                {{ $order->user->email }}

            </dd>

        </div>

        <div>

            <dt>Telefone</dt>

            <dd>

                {{ $order->user->phone }}

            </dd>

        </div>

    </dl>

</x-admin.cards.card>
