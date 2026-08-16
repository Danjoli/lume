<x-admin.app-layout title="Envios">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Envios" description="Gerencie os envios dos pedidos." />

        <x-alerts.flash />

        @include('admin.shipments._partials.filters')

        @include('admin.shipments._partials.table')

        <x-admin.tables.pagination :paginator="$shipments" />

    </div>

</x-admin.app-layout>
