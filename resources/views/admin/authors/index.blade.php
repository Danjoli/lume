<x-admin.app-layout title="Autores">

    <div class="space-y-8">

        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">

            <div>

                <h1 class="text-3xl font-bold text-slate-900">

                    Autores

                </h1>

                <p class="mt-1 text-slate-500">

                    Gerencie todos os autores cadastrados.

                </p>

            </div>

            <a
                href="{{ route('admin.authors.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-indigo-700"
            >

                Novo Autor

            </a>

        </div>

        @if(session('success'))

            <div class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

                {{ session('success') }}

            </div>

        @endif

        @include('admin.authors._partials.filters')

        @include('admin.authors._partials.table')

    </div>

</x-admin.app-layout>