<x-admin.cards.card content-class="p-4">
    <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
        <div class="flex min-w-0 items-center gap-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-700">
                <x-heroicon-o-truck class="h-5 w-5" />
            </div>
            <div class="min-w-0">
                <div class="flex flex-wrap items-center gap-2">
                    <h2 class="font-semibold text-slate-900">Operação do envio</h2>
                    <x-badges.status-badge :status="$shipment->status" />
                </div>
                <p class="mt-0.5 text-xs text-slate-500">
                    @if ($shipment->canGenerateLabel())
                        Prepare o envio para iniciar a emissão da etiqueta.
                    @elseif ($shipment->canPurchaseLabel())
                        O envio está preparado e aguarda a compra da etiqueta.
                    @elseif ($shipment->canPrintLabel() && $shipment->isPreparing())
                        Etiqueta pronta. Imprima antes de registrar a postagem.
                    @elseif ($shipment->isShipped())
                        Envio postado. Atualize o rastreamento ou confirme a entrega.
                    @else
                        Consulte abaixo os dados e o histórico desta entrega.
                    @endif
                </p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            @if ($shipment->canGenerateLabel())
                <form method="POST" action="{{ route('admin.shipments.generate-label', $shipment) }}">
                    @csrf @method('PATCH')
                    <button class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                        <x-heroicon-o-cube class="h-4 w-4" /> Preparar etiqueta
                    </button>
                </form>
            @endif

            @if ($shipment->canPurchaseLabel())
                <form method="POST" action="{{ route('admin.shipments.purchase-label', $shipment) }}" onsubmit="return confirm('Confirma a compra e geração desta etiqueta no Melhor Envio?')">
                    @csrf @method('PATCH')
                    <button class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-3.5 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                        <x-heroicon-o-tag class="h-4 w-4" /> Comprar e gerar etiqueta
                    </button>
                </form>
            @endif

            @if ($shipment->canPrintLabel())
                <a target="_blank" rel="noopener" href="{{ $shipment->label_url }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-3.5 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                    <x-heroicon-o-printer class="h-4 w-4" /> Imprimir etiqueta
                </a>
            @endif

            @if ($shipment->canSyncTracking())
                <form method="POST" action="{{ route('admin.shipments.tracking', $shipment) }}">
                    @csrf @method('PATCH')
                    <button class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3.5 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        <x-heroicon-o-arrow-path class="h-4 w-4" /> Atualizar rastreio
                    </button>
                </form>
            @endif

            @if ($shipment->canBeShipped())
                <form method="POST" action="{{ route('admin.shipments.ship', $shipment) }}" onsubmit="return confirm('Confirma que o pacote foi postado?')">
                    @csrf @method('PATCH')
                    <button class="rounded-lg border border-blue-300 px-3.5 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-50">Marcar como enviado</button>
                </form>
            @endif

            @if ($shipment->canBeDelivered())
                <form method="POST" action="{{ route('admin.shipments.deliver', $shipment) }}" onsubmit="return confirm('Confirma que o pedido foi entregue?')">
                    @csrf @method('PATCH')
                    <button class="rounded-lg border border-emerald-300 px-3.5 py-2 text-sm font-semibold text-emerald-700 hover:bg-emerald-50">Marcar como entregue</button>
                </form>
            @endif

            @if ($shipment->isDelivered())
                <form method="POST" action="{{ route('admin.shipments.return', $shipment) }}" onsubmit="return confirm('Confirma a devolução deste envio?')">
                    @csrf @method('PATCH')
                    <button class="rounded-lg border border-orange-300 px-3.5 py-2 text-sm font-semibold text-orange-700 hover:bg-orange-50">Registrar devolução</button>
                </form>
            @endif

            @if ($shipment->canBeCancelled())
                <form method="POST" action="{{ route('admin.shipments.cancel', $shipment) }}" onsubmit="return confirm('Confirma o cancelamento deste envio?')">
                    @csrf @method('PATCH')
                    <button class="rounded-lg px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">Cancelar</button>
                </form>
            @endif
        </div>
    </div>
</x-admin.cards.card>
