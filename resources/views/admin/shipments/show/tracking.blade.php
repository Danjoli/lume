<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Rastreamento

    </h2>

    <dl class="space-y-4">

        <div>

            <dt>Código</dt>

            <dd>

                {{ $shipment->tracking_code ?: '-' }}

            </dd>

        </div>

        <div>

            <dt>Etiqueta</dt>

            <dd>

                {{ $shipment->melhor_envio_order_id ?: '-' }}

            </dd>

        </div>

        <div>

            <dt>Última atualização</dt>

            <dd>

                {{ optional($shipment->updated_at)->format('d/m/Y H:i') }}

            </dd>

        </div>

    </dl>

    @if($shipment->tracking_url)
        <a target="_blank" rel="noopener" href="{{ $shipment->tracking_url }}" class="mt-5 inline-flex rounded-lg border px-4 py-2 text-sm font-semibold">Acompanhar na transportadora</a>
    @endif

</x-admin.cards.card>
