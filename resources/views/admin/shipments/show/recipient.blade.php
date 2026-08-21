<x-admin.cards.card title="Destinatário" content-class="p-4">
    <div class="space-y-1.5 text-sm">
        <p class="font-semibold text-slate-900">{{ $shipment->order->recipient_name }}</p>
        <p class="truncate text-slate-600" title="{{ $shipment->order->user->email }}">{{ $shipment->order->user->email }}</p>
        <p class="text-slate-600">{{ $shipment->order->phone ?: 'Telefone não informado' }}</p>
    </div>
</x-admin.cards.card>
