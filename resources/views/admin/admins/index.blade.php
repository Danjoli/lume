<x-admin.app-layout title="Administradores">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Administradores" description="Gerencie os administradores do painel.">

            <x-buttons.primary-button :href="route('admin.admins.create')">
                Novo Administrador
            </x-buttons.primary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.admins._partials.filters')

        @include('admin.admins._partials.table')

        <x-admin.tables.pagination :paginator="$admins" />

    </div>

</x-admin.app-layout>
