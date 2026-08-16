@props([
    'categories',
    'authors',
    'publishers',
])

<div
    class="
        rounded-xl border border-[#E6E4DF]
        bg-white p-5
    "
>

    <form
        action="{{ route('store.catalog.index') }}"
        method="GET"
        class="space-y-6"
    >

        <div>

            <label
                for="search"
                class="text-sm font-semibold text-[#17231F]"
            >
                Buscar
            </label>

            <div class="relative mt-2">

                <input
                    id="search"
                    name="search"
                    type="search"
                    value="{{ request('search') }}"
                    placeholder="Título, autor ou ISBN..."
                    class="
                        h-11 w-full rounded-lg
                        border border-[#DDDCD7]
                        bg-white px-3 pr-10
                        text-sm outline-none
                        focus:border-[#0D5147]
                    "
                >

                <x-heroicon-o-magnifying-glass
                    class="
                        absolute right-3 top-1/2
                        h-4 w-4 -translate-y-1/2
                        text-[#7C8582]
                    "
                />

            </div>

        </div>

        <div>

            <label
                for="category"
                class="text-sm font-semibold text-[#17231F]"
            >
                Categoria
            </label>

            <select
                id="category"
                name="category"
                class="
                    mt-2 h-11 w-full rounded-lg
                    border border-[#DDDCD7]
                    bg-white px-3 text-sm
                "
            >

                <option value="">
                    Todas
                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        @selected(
                            request('category') == $category->id
                        )
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div>

            <label
                for="author"
                class="text-sm font-semibold text-[#17231F]"
            >
                Autor
            </label>

            <select
                id="author"
                name="author"
                class="
                    mt-2 h-11 w-full rounded-lg
                    border border-[#DDDCD7]
                    bg-white px-3 text-sm
                "
            >

                <option value="">
                    Todos
                </option>

                @foreach($authors as $author)

                    <option
                        value="{{ $author->id }}"
                        @selected(
                            request('author') == $author->id
                        )
                    >
                        {{ $author->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div>

            <label
                for="publisher"
                class="text-sm font-semibold text-[#17231F]"
            >
                Editora
            </label>

            <select
                id="publisher"
                name="publisher"
                class="
                    mt-2 h-11 w-full rounded-lg
                    border border-[#DDDCD7]
                    bg-white px-3 text-sm
                "
            >

                <option value="">
                    Todas
                </option>

                @foreach($publishers as $publisher)

                    <option
                        value="{{ $publisher->id }}"
                        @selected(
                            request('publisher') == $publisher->id
                        )
                    >
                        {{ $publisher->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div>

            <p class="text-sm font-semibold text-[#17231F]">
                Faixa de preço
            </p>

            <div class="mt-2 grid grid-cols-2 gap-2">

                <input
                    type="number"
                    name="min_price"
                    step="0.01"
                    min="0"
                    value="{{ request('min_price') }}"
                    placeholder="Mín."
                    class="
                        h-11 min-w-0 rounded-lg
                        border border-[#DDDCD7]
                        px-3 text-sm
                    "
                >

                <input
                    type="number"
                    name="max_price"
                    step="0.01"
                    min="0"
                    value="{{ request('max_price') }}"
                    placeholder="Máx."
                    class="
                        h-11 min-w-0 rounded-lg
                        border border-[#DDDCD7]
                        px-3 text-sm
                    "
                >

            </div>

        </div>

        <label class="flex items-center gap-3">

            <input
                type="checkbox"
                name="in_stock"
                value="1"
                @checked(request()->boolean('in_stock'))
                class="
                    rounded border-[#D8D6D0]
                    text-[#062B25]
                    focus:ring-[#062B25]
                "
            >

            <span class="text-sm text-[#33423E]">
                Somente em estoque
            </span>

        </label>

        <label class="flex items-center gap-3">

            <input
                type="checkbox"
                name="promotion"
                value="1"
                @checked(request()->boolean('promotion'))
                class="
                    rounded border-[#D8D6D0]
                    text-[#062B25]
                    focus:ring-[#062B25]
                "
            >

            <span class="text-sm text-[#33423E]">
                Somente promoções
            </span>

        </label>

        <div class="space-y-2">

            <button
                type="submit"
                class="
                    flex h-11 w-full items-center justify-center
                    rounded-lg bg-[#062B25]
                    text-sm font-semibold text-white
                    transition hover:bg-[#0B3C34]
                "
            >
                Aplicar filtros
            </button>

            <a
                href="{{ route('store.catalog.index') }}"
                class="
                    flex h-11 w-full items-center justify-center
                    rounded-lg border border-[#DDDCD7]
                    text-sm font-semibold text-[#35433F]
                    transition hover:bg-[#F7F6F2]
                "
            >
                Limpar
            </a>

        </div>

    </form>

</div>
