<x-admin.app-layout title="Autores">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Autores" description="Gerencie todos os autores cadastrados.">

            <x-buttons.primary-button href="{{ route('admin.authors.create') }}">

                Novo Autor

            </x-buttons.primary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.authors._partials.filters')

        @include('admin.authors._partials.table')

        <x-admin.tables.pagination :paginator="$authors" />

    </div>

</x-admin.app-layout>
