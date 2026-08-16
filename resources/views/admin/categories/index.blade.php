<x-admin.app-layout title="Categorias">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Categorias" description="Gerencie todas as categorias cadastradas.">

            <x-buttons.primary-button :href="route('admin.categories.create')">

                Nova Categoria

            </x-buttons.primary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.categories._partials.filters')

        @include('admin.categories._partials.table')

        <x-admin.tables.pagination :paginator="$categories" />

    </div>

</x-admin.app-layout>
