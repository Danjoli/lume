<x-admin.app-layout title="Editar Editora">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Editar Editora" description="Atualize as informações da editora.">

            <x-buttons.secondary-button :href="route('admin.publishers.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.publishers._partials.form')

    </div>

</x-admin.app-layout>
