<x-admin.app-layout title="Configurações">

    <div class="space-y-8">

        <x-admin.headers.page-header
            title="Configurações"
            description="Gerencie as configurações gerais da Lume."
        />

        <x-alerts.flash />

        @include('admin.settings._partials.melhor-envio')

        <form
            method="POST"
            action="{{ route('admin.settings.update') }}"
            enctype="multipart/form-data"
            class="space-y-6"
        >

            @csrf
            @method('PUT')

            @include('admin.settings._partials.store')

            @include('admin.settings._partials.contact')

            @include('admin.settings._partials.address')

            @include('admin.settings._partials.social')

            @include('admin.settings._partials.appearance')

            @include('admin.settings._partials.sales')

            @include('admin.settings._partials.shipping')

            @include('admin.settings._partials.inventory')

            @include('admin.settings._partials.reviews')

            @include('admin.settings._partials.seo')

            @include('admin.settings._partials.email')

            <x-forms.actions>

                <x-buttons.primary-button type="submit">
                    Salvar configurações
                </x-buttons.primary-button>

            </x-forms.actions>

        </form>

    </div>

</x-admin.app-layout>
