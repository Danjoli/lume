<x-admin.app-layout title="Novo Cupom">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Novo Cupom" description="Cadastre um novo cupom.">

            <x-buttons.secondary-button :href="route('admin.coupons.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.coupons._partials.form')

    </div>

</x-admin.app-layout>
