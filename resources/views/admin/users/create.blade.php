<x-admin.app-layout title="Novo Usuário">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Novo Usuário" description="Cadastre um novo usuário.">

            <x-buttons.secondary-button :href="route('admin.users.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.users._partials.form')

    </div>

</x-admin.app-layout>
