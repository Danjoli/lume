<x-admin.app-layout title="Novo Livro">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Novo Livro" description="Cadastre um novo livro.">

            <x-buttons.secondary-button :href="route('admin.books.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        <x-forms.form :action="route('admin.books.store')" enctype="multipart/form-data">

            @include('admin.books.form.basic-information')

            @include('admin.books.form.publication')

            @include('admin.books.form.pricing')

            @include('admin.books.form.inventory')

            @include('admin.books.form.relationships')

            @include('admin.books.form.media')

            @include('admin.books.form.seo')

            <x-forms.actions>

                <x-buttons.secondary-button :href="route('admin.books.index')">

                    Cancelar

                </x-buttons.secondary-button>

                <x-buttons.primary-button type="submit">

                    Salvar

                </x-buttons.primary-button>

            </x-forms.actions>

        </x-forms.form>

    </div>

</x-admin.app-layout>
