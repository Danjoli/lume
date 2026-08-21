<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Histórico

    </h2>

    <ul class="space-y-4">

        @forelse ($shipment->tracking_history ?? [] as $event)
            <li>

                <p class="font-medium">

                    {{ data_get($event, 'description', data_get($event, 'status', 'Atualização do envio')) }}

                </p>

                <p class="text-sm text-slate-500">

                    {{ ($date = data_get($event, 'date')) ? \Illuminate\Support\Carbon::parse($date)->format('d/m/Y H:i') : 'Data não informada' }}

                </p>

            </li>
        @empty
            <li class="text-sm text-slate-500">Nenhum evento de rastreamento registrado.</li>
        @endforelse

    </ul>

</x-admin.cards.card>
