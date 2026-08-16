<x-admin.app-layout title="Novo Autor">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Novo Autor" description="Cadastre um novo autor.">

            <x-buttons.secondary-button :href="route('admin.authors.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.authors._partials.form')

    </div>

</x-admin.app-layout>
