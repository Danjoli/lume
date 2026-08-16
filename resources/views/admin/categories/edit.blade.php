<x-admin.app-layout title="Editar Categoria">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Editar Categoria" description="Atualize os dados da categoria.">

            <x-buttons.secondary-button :href="route('admin.categories.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.categories._partials.form')

    </div>

</x-admin.app-layout>
