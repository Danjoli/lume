<x-admin.app-layout title="Envios">

    <div class="space-y-5">

        <x-admin.headers.page-header title="Envios" description="Etiquetas, rastreamento e andamento das entregas em um só lugar." />

        <x-alerts.flash />

        @include('admin.shipments._partials.filters')

        @include('admin.shipments._partials.table')

        <x-admin.tables.pagination :paginator="$shipments" />

    </div>

</x-admin.app-layout>
