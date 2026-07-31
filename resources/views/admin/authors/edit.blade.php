<x-admin.app-layout title="Editar Autor">

    <div class="space-y-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-900">

                Editar Autor

            </h1>

            <p class="mt-1 text-slate-500">

                Atualize os dados do autor.

            </p>

        </div>

        <x-admin.cards.card>

            <form
                action="{{ route('admin.authors.update', $author) }}"
                method="POST"
            >

                @csrf

                @method('PUT')

                @include('admin.authors._partials.form')

            </form>

        </x-admin.cards.card>

    </div>

</x-admin.app-layout>
