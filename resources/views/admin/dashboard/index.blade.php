<x-admin.app-layout title="Dashboard">

    <div class="mb-8">

        <h1 class="text-4xl font-bold text-slate-900">
            Dashboard
        </h1>

        <p class="mt-2 text-slate-500">
            Bem-vindo(a) ao painel administrativo da Lume.
        </p>

    </div>

    <div class="space-y-8">

        @include('admin.dashboard.stats')

        <div class="grid grid-cols-1 gap-8 xl:grid-cols-3">

            <div class="xl:col-span-2">

                @include('admin.dashboard.orders-chart')

            </div>

            <div class="xl:col-span-1">

                @include('admin.dashboard.orders-status')

            </div>

        </div>

        <div class="grid grid-cols-1 gap-8 xl:grid-cols-2">

            @include('admin.dashboard.recent-orders')

            @include('admin.dashboard.best-selling-books')

        </div>

    </div>

</x-admin.app-layout>
