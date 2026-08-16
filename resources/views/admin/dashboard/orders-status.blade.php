<x-admin.cards.card title="Pedidos por status">

    @php
        $total = collect($ordersStatus)->sum('value');
    @endphp

    <div class="flex flex-col gap-8 xl:flex-row xl:items-center">

        <div class="flex justify-center xl:w-1/2 xl:flex-shrink-0">

            <div class="relative aspect-square w-full max-w-[200px]">
                <canvas id="orders-status-chart"></canvas>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const canvas = document.getElementById('orders-status-chart');

            if (!canvas) return;

            new Chart(canvas, {

                type: 'doughnut',

                data: {

                    labels: @json(collect($ordersStatus)->pluck('label')),

                    datasets: [{

                        data: @json(collect($ordersStatus)->pluck('value')),

                        backgroundColor: @json(collect($ordersStatus)->pluck('color')),

                        borderWidth: 0,

                        hoverOffset: 4,

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '62%',

                    plugins: {

                        legend: {
                            display: false,
                        },

                        tooltip: {

                            backgroundColor: '#FFFFFF',

                            titleColor: '#0F172A',

                            bodyColor: '#475569',

                            borderColor: '#E2E8F0',

                            borderWidth: 1,

                            cornerRadius: 10,

                            padding: 12,

                            displayColors: false,

                        }

                    }

                }

            });

        });
    </script>
@endpush
