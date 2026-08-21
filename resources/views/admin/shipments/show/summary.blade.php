<x-admin.cards.card title="Resumo do envio" content-class="p-4">
    <dl class="grid grid-cols-2 gap-x-5 gap-y-4 md:grid-cols-4">
        @php
            $items = [
                ['Pedido', '#'.$shipment->order->number],
                ['Transportadora', $shipment->carrier ?: '-'],
                ['Serviço', $shipment->service ?: '-'],
                ['Frete', 'R$ '.number_format((float) $shipment->shipping_cost, 2, ',', '.')],
                ['Prazo', ($shipment->delivery_min_days && $shipment->delivery_max_days) ? $shipment->delivery_min_days.' a '.$shipment->delivery_max_days.' dias úteis' : '-'],
                ['Criado em', $shipment->created_at->format('d/m/Y H:i')],
                ['Postado em', $shipment->shipped_at?->format('d/m/Y H:i') ?: '-'],
                ['Entregue em', $shipment->delivered_at?->format('d/m/Y H:i') ?: '-'],
            ];
        @endphp

        @foreach ($items as [$label, $value])
            <div class="min-w-0">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">{{ $label }}</dt>
                <dd class="mt-1 truncate text-sm font-semibold text-slate-800" title="{{ $value }}">{{ $value }}</dd>
            </div>
        @endforeach
    </dl>
</x-admin.cards.card>
