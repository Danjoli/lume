<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Resumo do Pedido

    </h2>

    <dl class="grid gap-6 md:grid-cols-2">

        <div>

            <dt>Total</dt>

            <dd>

                R$ {{ number_format($order->total, 2, ',', '.') }}

            </dd>

        </div>

        <div>

            <dt>Frete</dt>

            <dd>

                R$ {{ number_format($order->shipping_cost, 2, ',', '.') }}

            </dd>

        </div>

        <div>

            <dt>Desconto</dt>

            <dd>

                R$ {{ number_format($order->discount, 2, ',', '.') }}

            </dd>

        </div>

        <div>

            <dt>Status</dt>

            <dd>

                <x-badges.status-badge :status="$order->status" />

            </dd>

        </div>

    </dl>

</x-admin.cards.card>
