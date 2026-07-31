<x-admin.app-layout title="Novo Autor">

    <div class="space-y-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-900">

                Novo Autor

            </h1>

            <p class="mt-1 text-slate-500">

                Cadastre um novo autor.

            </p>

        </div>

        <x-admin.cards.card>

            <form
                action="{{ route('admin.authors.store') }}"
                method="POST"
            >

                @csrf

                @include('admin.authors._partials.form')

            </form>

        </x-admin.cards.card>

    </div>

</x-admin.app-layout>
