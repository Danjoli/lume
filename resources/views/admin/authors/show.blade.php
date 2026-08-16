<x-admin.app-layout :title="$author->name">

    <div class="space-y-8">

        <x-admin.headers.page-header :title="$author->name" description="Visualize os dados do autor.">

            <div class="flex gap-3">

                <x-buttons.secondary-button href="{{ route('admin.authors.index') }}">

                    Voltar

                </x-buttons.secondary-button>

                <x-buttons.primary-button href="{{ route('admin.authors.edit', $author) }}">

                    Editar

                </x-buttons.primary-button>

            </div>

        </x-admin.headers.page-header>

        <x-admin.cards.card>

            <dl class="grid grid-cols-1 gap-6 md:grid-cols-2">

                <div>

                    <dt class="text-sm font-medium text-slate-500">

                        Nome

                    </dt>

                    <dd class="mt-1 text-slate-900">

                        {{ $author->name }}

                    </dd>

                </div>

                <div>

                    <dt class="text-sm font-medium text-slate-500">

                        Slug

                    </dt>

                    <dd class="mt-1 text-slate-900">

                        {{ $author->slug }}

                    </dd>

                </div>

                <div class="md:col-span-2">

                    <dt class="text-sm font-medium text-slate-500">

                        Biografia

                    </dt>

                    <dd class="mt-1 text-slate-900">

                        {{ $author->biography ?: 'Não informada.' }}

                    </dd>

                </div>

                <div>

                    <dt class="text-sm font-medium text-slate-500">

                        Criado em

                    </dt>

                    <dd class="mt-1">

                        {{ $author->created_at->format('d/m/Y H:i') }}

                    </dd>

                </div>

                <div>

                    <dt class="text-sm font-medium text-slate-500">

                        Atualizado em

                    </dt>

                    <dd class="mt-1">

                        {{ $author->updated_at->format('d/m/Y H:i') }}

                    </dd>

                </div>

            </dl>

        </x-admin.cards.card>

    </div>

</x-admin.app-layout>
