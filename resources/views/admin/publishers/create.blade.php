<x-admin.app-layout title="Nova Editora">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Nova Editora" description="Cadastre uma nova editora.">

            <x-buttons.secondary-button :href="route('admin.publishers.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.publishers._partials.form')

    </div>

</x-admin.app-layout>
