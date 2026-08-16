<x-admin.app-layout title="Pedidos">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Pedidos" description="Gerencie todos os pedidos realizados na loja." />

        <x-alerts.flash />

        @include('admin.orders._partials.filters')

        @include('admin.orders._partials.table')

        <x-admin.tables.pagination :paginator="$orders" />

    </div>

</x-admin.app-layout>
