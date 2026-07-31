<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

    <form
        action="{{ route('admin.authors.index') }}"
        method="GET"
    >

        <div class="flex flex-col gap-4 lg:flex-row lg:items-end">

            <div class="flex-1">

                <label
                    for="search"
                    class="mb-2 block text-sm font-medium text-slate-700"
                >
                    Pesquisar
                </label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Nome do autor..."
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                >

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-medium text-white transition hover:bg-indigo-700"
                >
                    Buscar
                </button>

                <a
                    href="{{ route('admin.authors.index') }}"
                    class="rounded-xl border border-slate-300 px-6 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100"
                >
                    Limpar
                </a>

            </div>

        </div>

    </form>

</div>
