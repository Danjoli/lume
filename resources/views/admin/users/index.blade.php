<x-admin.app-layout title="Usuários">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Usuários" description="Gerencie todos os usuários cadastrados." />

        <x-alerts.flash />

        @include('admin.users._partials.filters')

        @include('admin.users._partials.table')

    </div>

</x-admin.app-layout>
