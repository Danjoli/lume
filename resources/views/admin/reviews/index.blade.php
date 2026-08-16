<x-admin.app-layout title="Avaliações">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Avaliações" description="Gerencie as avaliações dos clientes." />

        <x-alerts.flash />

        @include('admin.reviews._partials.filters')

        @include('admin.reviews._partials.table')

        <x-admin.tables.pagination :paginator="$reviews" />

    </div>

</x-admin.app-layout>
