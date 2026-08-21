<x-admin.cards.card title="Endereço de entrega" content-class="p-4">
    <address class="space-y-1 text-sm not-italic text-slate-600">
        <p class="font-medium text-slate-900">{{ $shipment->order->street }}, {{ $shipment->order->number }}</p>
        @if ($shipment->order->complement)<p>{{ $shipment->order->complement }}</p>@endif
        <p>{{ $shipment->order->neighborhood }} • {{ $shipment->order->city }}/{{ $shipment->order->state }}</p>
        <p>CEP {{ $shipment->order->cep }}</p>
    </address>
</x-admin.cards.card>
