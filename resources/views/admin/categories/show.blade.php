<x-admin.app-layout :title="$category->name">

    <div class="space-y-8">

        <x-admin.headers.page-header :title="$category->name" description="Visualize as informações da categoria.">

            <div class="flex gap-3">

                <x-buttons.secondary-button :href="route('admin.categories.index')">

                    Voltar

                </x-buttons.secondary-button>

                <x-buttons.primary-button :href="route('admin.categories.edit', $category)">

                    Editar

                </x-buttons.primary-button>

            </div>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        <x-admin.cards.details-card>

            <div>

                <dt>Nome</dt>

                <dd>{{ $category->name }}</dd>

            </div>

            <div>

                <dt>Slug</dt>

                <dd>{{ $category->slug }}</dd>

            </div>

            <div class="md:col-span-2">

                <dt>Descrição</dt>

                <dd>{{ $category->description ?: 'Nenhuma descrição cadastrada.' }}</dd>

            </div>

            <div>

                <dt>Livros</dt>

                <dd>

                    <x-badges.badge>

                        {{ $category->books_count }}

                    </x-badges.badge>

                </dd>

            </div>

            <div>

                <dt>Criado em</dt>

                <dd>{{ $category->created_at->format('d/m/Y H:i') }}</dd>

            </div>

        </x-admin.cards.details-card>

    </div>

</x-admin.app-layout>
