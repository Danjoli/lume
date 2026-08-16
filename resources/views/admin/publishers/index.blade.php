<x-admin.app-layout title="Editoras">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Editoras" description="Gerencie todas as editoras cadastradas.">

            <x-buttons.primary-button :href="route('admin.publishers.create')">

                Nova Editora

            </x-buttons.primary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.publishers._partials.filters')

        @include('admin.publishers._partials.table')

        <x-admin.tables.pagination :paginator="$publishers" />

    </div>

</x-admin.app-layout>
