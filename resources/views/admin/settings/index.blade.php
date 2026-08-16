<x-admin.app-layout title="Configurações">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Configurações" description="Gerencie as configurações da loja." />

        <x-alerts.flash />

        <x-forms.form :action="route('admin.settings.update')" method="PUT">

            @include('admin.settings._partials.general')

            @include('admin.settings._partials.store')

            @include('admin.settings._partials.payment')

            @include('admin.settings._partials.shipping')

            @include('admin.settings._partials.mail')

            @include('admin.settings._partials.seo')

            <x-forms.actions>

                <x-buttons.primary-button type="submit">

                    Salvar Alterações

                </x-buttons.primary-button>

            </x-forms.actions>

        </x-forms.form>

    </div>

</x-admin.app-layout>
