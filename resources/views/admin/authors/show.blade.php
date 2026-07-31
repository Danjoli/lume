<x-admin.app-layout title="Autor">

    <div class="space-y-8">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-slate-900">

                    {{ $author->name }}

                </h1>

                <p class="mt-1 text-slate-500">

                    Detalhes do autor.

                </p>

            </div>

            <a
                href="{{ route('admin.authors.edit', $author) }}"
                class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-indigo-700"
            >
                Editar
            </a>

        </div>

        <x-admin.cards.card>

            <dl class="grid gap-6 md:grid-cols-2">

                <div>

                    <dt class="text-sm font-medium text-slate-500">

                        Nome

                    </dt>

                    <dd class="mt-1 text-lg font-semibold text-slate-900">

                        {{ $author->name }}

                    </dd>

                </div>

                <div>

                    <dt class="text-sm font-medium text-slate-500">

                        Livros cadastrados

                    </dt>

                    <dd class="mt-1 text-lg font-semibold text-slate-900">

                        {{ $author->books_count }}

                    </dd>

                </div>

                <div class="md:col-span-2">

                    <dt class="text-sm font-medium text-slate-500">

                        Biografia

                    </dt>

                    <dd class="mt-2 rounded-xl bg-slate-50 p-4 text-slate-700">

                        {{ $author->biography ?: 'Nenhuma biografia cadastrada.' }}

                    </dd>

                </div>

                <div>

                    <dt class="text-sm font-medium text-slate-500">

                        Criado em

                    </dt>

                    <dd class="mt-1 text-slate-700">

                        {{ $author->created_at->format('d/m/Y H:i') }}

                    </dd>

                </div>

                <div>

                    <dt class="text-sm font-medium text-slate-500">

                        Atualizado em

                    </dt>

                    <dd class="mt-1 text-slate-700">

                        {{ $author->updated_at->format('d/m/Y H:i') }}

                    </dd>

                </div>

            </dl>

        </x-admin.cards.card>

    </div>

</x-admin.app-layout>
