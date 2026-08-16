<x-admin.app-layout title="Livros">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Livros" description="Gerencie todos os livros cadastrados.">

            <x-buttons.primary-button :href="route('admin.books.create')">

                Novo Livro

            </x-buttons.primary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.books._partials.filters')

        @include('admin.books._partials.table')

        <x-admin.tables.pagination :paginator="$books" />

    </div>

</x-admin.app-layout>
