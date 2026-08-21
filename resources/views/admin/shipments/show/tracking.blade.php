<x-admin.cards.card title="Etiqueta e rastreamento" content-class="p-4">
    <dl class="grid gap-4 sm:grid-cols-3">
        <div>
            <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Código</dt>
            <dd class="mt-1 font-mono text-sm font-semibold text-slate-800">{{ $shipment->tracking_code ?: '-' }}</dd>
        </div>
        <div class="min-w-0">
            <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">ID da etiqueta</dt>
            <dd class="mt-1 truncate text-sm font-semibold text-slate-800" title="{{ $shipment->melhor_envio_order_id }}">{{ $shipment->melhor_envio_order_id ?: '-' }}</dd>
        </div>
        <div>
            <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Atualizado em</dt>
            <dd class="mt-1 text-sm font-semibold text-slate-800">{{ $shipment->updated_at?->format('d/m/Y H:i') ?: '-' }}</dd>
        </div>
    </dl>

    @if ($shipment->tracking_url)
        <a target="_blank" rel="noopener" href="{{ $shipment->tracking_url }}" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800">
            Acompanhar na transportadora <x-heroicon-o-arrow-top-right-on-square class="h-4 w-4" />
        </a>
    @endif
</x-admin.cards.card>
