<x-admin.cards.card>

    <div class="flex flex-wrap gap-3">

        @if($shipment->isPending())
            <form method="POST" action="{{ route('admin.shipments.generate-label', $shipment) }}">@csrf @method('PATCH')
                <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Preparar etiqueta</button>
            </form>
        @endif

        @if($shipment->isPreparing() && ! $shipment->label_url)
            <form method="POST" action="{{ route('admin.shipments.purchase-label', $shipment) }}">@csrf @method('PATCH')
                <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Comprar e gerar etiqueta</button>
            </form>
        @endif

        @if($shipment->melhor_envio_order_id)
            <form method="POST" action="{{ route('admin.shipments.tracking', $shipment) }}">@csrf @method('PATCH')
                <button class="rounded-lg border px-4 py-2 text-sm font-semibold">Atualizar rastreamento</button>
            </form>
        @endif

        @if($shipment->label_url)
            <a target="_blank" rel="noopener" href="{{ $shipment->label_url }}" class="rounded-lg border px-4 py-2 text-sm font-semibold">Imprimir etiqueta</a>
        @endif

    </div>

</x-admin.cards.card>
