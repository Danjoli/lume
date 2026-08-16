<x-admin.app-layout title="Notificações">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Notificações" description="Gerencie todas as notificações do sistema." />

        <x-alerts.flash />

        @include('admin.notifications._partials.filters')

        @include('admin.notifications._partials.table')

        <x-admin.tables.pagination :paginator="$notifications" />

    </div>

</x-admin.app-layout>
