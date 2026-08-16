<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Pagamento

    </h2>

    <dl class="space-y-4">

        <div>

            <dt>Método</dt>

            <dd>

                {{ $order->payment_method }}

            </dd>

        </div>

        <div>

            <dt>Status</dt>

            <dd>

                <x-badges.payment-status-badge :status="$order->payment_status" />

            </dd>

        </div>

        <div>

            <dt>ID Gateway</dt>

            <dd>

                {{ $order->payment_id }}

            </dd>

        </div>

    </dl>

</x-admin.cards.card>
