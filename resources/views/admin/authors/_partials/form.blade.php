<div class="space-y-6">

    <div>

        <label
            for="name"
            class="mb-2 block text-sm font-medium text-slate-700"
        >
            Nome
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $author->name ?? '') }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('name') border-red-500 @enderror"
        >

        @error('name')

            <p class="mt-2 text-sm text-red-600">

                {{ $message }}

            </p>

        @enderror

    </div>

    <div>

        <label
            for="biography"
            class="mb-2 block text-sm font-medium text-slate-700"
        >
            Biografia
        </label>

        <textarea
            id="biography"
            name="biography"
            rows="8"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('biography') border-red-500 @enderror"
        >{{ old('biography', $author->biography ?? '') }}</textarea>

        @error('biography')

            <p class="mt-2 text-sm text-red-600">

                {{ $message }}

            </p>

        @enderror

    </div>

    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">

        <a
            href="{{ route('admin.authors.index') }}"
            class="rounded-xl border border-slate-300 px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100"
        >
            Cancelar
        </a>

        <button
            type="submit"
            class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-indigo-700"
        >
            Salvar
        </button>

    </div>

</div>
