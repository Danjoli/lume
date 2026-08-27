<x-admin.cards.card title="Pedidos por status">

    @php
        $total = collect($ordersStatus)->sum('value');
    @endphp

    <div class="flex flex-col gap-8 xl:flex-row xl:items-center">

        <div class="flex justify-center xl:w-1/2 xl:flex-shrink-0">

            <div class="relative aspect-square w-full max-w-[200px]">
                <canvas
                    id="orders-status-chart"
                    data-admin-chart="orders-status"
                    data-chart-labels="{{ json_encode(collect($ordersStatus)->pluck('label')->values()) }}"
                    data-chart-values="{{ json_encode(collect($ordersStatus)->pluck('value')->values()) }}"
                    data-chart-colors="{{ json_encode(collect($ordersStatus)->pluck('color')->values()) }}"
                ></canvas>
            </div>

        </div>

        <div class="flex-1 space-y-5">

            @foreach ($ordersStatus as $item)
                <div class="flex items-center gap-3">

                    <span class="h-3 w-3 rounded-full {{ $item['tailwind'] }}">
                    </span>

                    <div>

                        <p class="text-sm font-medium text-slate-700">
                            {{ $item['label'] }}
                        </p>

                        <p class="text-sm text-slate-500">

                            {{ $item['value'] }}

                            ({{ $total > 0 ? round(($item['value'] / $total) * 100) : 0 }}%)
                        </p>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</x-admin.cards.card>
