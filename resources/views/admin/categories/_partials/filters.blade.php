<x-admin.cards.card>

    <form method="GET" action="{{ route('admin.categories.index') }}">

        <div class="flex flex-col gap-4 lg:flex-row lg:items-end">

            <div class="flex-1">

                <x-forms.label for="search">

                    Pesquisar

                </x-forms.label>

                <x-forms.search id="search" name="search" placeholder="Nome da categoria..." />

            </div>

            <div class="flex gap-3">

                <x-buttons.primary-button type="submit">

                    Filtrar

                </x-buttons.primary-button>

                <x-buttons.secondary-button :href="route('admin.categories.index')">

                    Limpar

                </x-buttons.secondary-button>

            </div>

        </div>

    </form>

</x-admin.cards.card>
