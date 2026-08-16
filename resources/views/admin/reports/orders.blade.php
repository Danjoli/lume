<x-admin.app-layout title="Relatório de Pedidos">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Relatório de Pedidos" description="Analise o desempenho dos pedidos.">

            <x-buttons.secondary-button :href="route('admin.reports.dashboard')">
                Voltar
            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <h2 class="text-lg font-semibold text-slate-900">
                Pedidos
            </h2>

            <div class="mt-6">

                @if (is_array($report))

                    @foreach ($report as $key => $value)
                        <div class="flex justify-between border-b border-slate-100 py-3">

                            <span class="text-sm text-slate-500">
                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                            </span>

                            <span class="font-medium text-slate-900">
                                {{ $value }}
                            </span>

                        </div>
                    @endforeach
                @else
                    <p class="text-sm text-slate-500">
                        Nenhum dado disponível.
                    </p>

                @endif

            </div>

        </div>

    </div>

</x-admin.app-layout>
