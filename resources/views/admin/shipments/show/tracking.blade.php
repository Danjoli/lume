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

                {{ $shipment->label_id ?: '-' }}

            </dd>

        </div>

        <div>

            <dt>Última atualização</dt>

            <dd>

                {{ optional($shipment->updated_at)->format('d/m/Y H:i') }}

            </dd>

        </div>

    </dl>

</x-admin.cards.card>
