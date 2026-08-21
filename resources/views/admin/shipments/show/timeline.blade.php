<x-admin.cards.card title="Histórico" content-class="p-4">
    <ol class="space-y-3">
        @forelse ($shipment->tracking_history ?? [] as $event)
            @php($date = data_get($event, 'date', data_get($event, 'received_at')))
            <li class="relative border-l-2 border-slate-200 pl-4">
                <span class="absolute -left-[5px] top-1.5 h-2 w-2 rounded-full bg-indigo-500"></span>
                <p class="text-sm font-medium text-slate-800">{{ data_get($event, 'description', data_get($event, 'status', data_get($event, 'event', 'Atualização do envio'))) }}</p>
                <p class="mt-0.5 text-xs text-slate-500">{{ $date ? \Illuminate\Support\Carbon::parse($date)->format('d/m/Y H:i') : 'Data não informada' }}</p>
            </li>
        @empty
            <li class="rounded-lg bg-slate-50 px-3 py-2 text-sm text-slate-500">Nenhum evento de rastreamento registrado.</li>
        @endforelse
    </ol>
</x-admin.cards.card>
