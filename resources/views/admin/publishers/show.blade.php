<x-admin.app-layout :title="$publisher->name">

    <div class="space-y-8">

        <x-admin.headers.page-header :title="$publisher->name" description="Visualize as informações da editora.">

            <div class="flex gap-3">

                <x-buttons.secondary-button :href="route('admin.publishers.index')">
                    Voltar
                </x-buttons.secondary-button>

                <x-buttons.primary-button :href="route('admin.publishers.edit', $publisher)">
                    Editar
                </x-buttons.primary-button>

            </div>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        <x-admin.cards.details-card>

            <div>

                <dt>Nome</dt>

                <dd>{{ $publisher->name }}</dd>

            </div>

            <div>

                <dt>Slug</dt>

                <dd>{{ $publisher->slug }}</dd>

            </div>

            <div class="md:col-span-2">

                <dt>Descrição</dt>

                <dd>{{ $publisher->description ?: 'Nenhuma descrição cadastrada.' }}</dd>

            </div>

            <div>

                <dt>Livros</dt>

                <dd>

                    <x-badges.badge>

                        {{ $publisher->books_count }}

                    </x-badges.badge>

                </dd>

            </div>

            <div>

                <dt>Criado em</dt>

                <dd>{{ $publisher->created_at->format('d/m/Y H:i') }}</dd>

            </div>

        </x-admin.cards.details-card>

    </div>

</x-admin.app-layout>
