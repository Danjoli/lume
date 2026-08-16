<x-admin.app-layout title="Editar Autor">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Editar Autor" description="Atualize as informações do autor.">

            <x-buttons.secondary-button :href="route('admin.authors.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.authors._partials.form')

    </div>

</x-admin.app-layout>
