<x-admin.app-layout title="Editar Usuário">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Editar Usuário" description="Atualize as informações do usuário.">

            <x-buttons.secondary-button :href="route('admin.users.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.users._partials.form')

    </div>

</x-admin.app-layout>
