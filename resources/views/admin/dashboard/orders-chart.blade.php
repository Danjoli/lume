<x-admin.cards.card title="Pedidos dos últimos 7 dias">

    <x-admin.charts.line-chart id="sales-chart" :height="260" />

</x-admin.cards.card>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const canvas = document.getElementById('sales-chart');

            if (!canvas) return;

            const ctx = canvas.getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 280);

            gradient.addColorStop(0, 'rgba(99,102,241,.10)');
            gradient.addColorStop(.5, 'rgba(99,102,241,.04)');
            gradient.addColorStop(1, 'rgba(99,102,241,0)');

            new Chart(canvas, {

                type: 'line',

                data: {

                    labels: @json(collect($ordersChart)->pluck('label')),

                    datasets: [{

                        label: 'Pedidos',

                        data: @json(collect($ordersChart)->pluck('value')),

                        borderColor: '#6366F1',

                        backgroundColor: gradient,

                        fill: true,

                        borderWidth: 2,

                        tension: .10,

                        pointRadius: 3,

                        pointHoverRadius: 5,

                        pointBackgroundColor: '#FFFFFF',

                        pointBorderColor: '#6366F1',

                        pointBorderWidth: 2,

                        clip: 20,

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    layout: {

                        padding: {

                            top: 10,
                            right: 15,
                            bottom: 5,
                            left: 10,

                        }

                    },

                    interaction: {

                        mode: 'index',

                        intersect: false,

                    },

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

                    },

                    scales: {

                        x: {

                            offset: true,

                            grid: {

                                display: false,

                            },

                            border: {

                                display: false,

                            },

                            ticks: {

                                color: '#94A3B8',

                                padding: 14,

                                font: {

                                    size: 12,

                                    weight: 500,

                                }

                            }

                        },

                        y: {

                            beginAtZero: true,

                            suggestedMax: 60,

                            border: {

                                display: false,

                            },

                            grid: {

                                color: '#EEF2F7',

                                drawBorder: false,

                            },

                            ticks: {

                                stepSize: 10,

                                padding: 12,

                                color: '#94A3B8',

                                font: {

                                    size: 12,

                                    weight: 500,

                                }

                            }

                        }

                    }

                }

            });

        });
    </script>
@endpush
