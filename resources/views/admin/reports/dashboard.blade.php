<x-admin.app-layout title="Relatórios">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Relatórios" description="Acompanhe os principais indicadores da loja." />

        <x-alerts.flash />

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-slate-500">
                    Vendas
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $stats['sales'] ?? 0 }}
                </p>

            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-slate-500">
                    Pedidos
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $stats['orders'] ?? 0 }}
                </p>

            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-slate-500">
                    Clientes
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $stats['customers'] ?? 0 }}
                </p>

            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-slate-500">
                    Livros vendidos
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $stats['books'] ?? 0 }}
                </p>

            </div>

        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

            <a href="{{ route('admin.reports.sales') }}"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-indigo-300 hover:shadow-md">

                <h2 class="text-lg font-semibold text-slate-900">
                    Vendas
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Consulte o desempenho das vendas.
                </p>

            </a>

            <a href="{{ route('admin.reports.orders') }}"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-indigo-300 hover:shadow-md">

                <h2 class="text-lg font-semibold text-slate-900">
                    Pedidos
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Analise os pedidos realizados.
                </p>

            </a>

            <a href="{{ route('admin.reports.books') }}"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-indigo-300 hover:shadow-md">

                <h2 class="text-lg font-semibold text-slate-900">
                    Livros
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Veja o desempenho dos livros.
                </p>

            </a>

            <a href="{{ route('admin.reports.customers') }}"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-indigo-300 hover:shadow-md">

                <h2 class="text-lg font-semibold text-slate-900">
                    Clientes
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Analise os dados dos clientes.
                </p>

            </a>

            <a href="{{ route('admin.reports.finance') }}"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-indigo-300 hover:shadow-md">

                <h2 class="text-lg font-semibold text-slate-900">
                    Financeiro
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Consulte os indicadores financeiros.
                </p>

            </a>

        </div>

    </div>

</x-admin.app-layout>
