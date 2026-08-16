@props([
    'books',
])

<div
    class="
        flex flex-col gap-4
        border-b border-[#E7E5E0]
        pb-5
        sm:flex-row
        sm:items-center
        sm:justify-between
    "
>

    <p class="text-sm text-[#66716D]">

        <strong class="font-semibold text-[#17231F]">
            {{ $books->total() }}
        </strong>

        {{ $books->total() === 1 ? 'livro encontrado' : 'livros encontrados' }}

    </p>

    <form
        action="{{ route('store.catalog.index') }}"
        method="GET"
        class="flex items-center gap-2"
    >

        @foreach(request()->except('sort', 'page') as $key => $value)

            @if(is_scalar($value))

                <input
                    type="hidden"
                    name="{{ $key }}"
                    value="{{ $value }}"
                >

            @endif

        @endforeach

        <label
            for="sort"
            class="text-sm text-[#66716D]"
        >
            Ordenar:
        </label>

        <select
            id="sort"
            name="sort"
            onchange="this.form.submit()"
            class="
                h-10 rounded-lg
                border border-[#DDDCD7]
                bg-white px-3
                text-sm text-[#17231F]
            "
        >

            <option
                value=""
                @selected(! request('sort'))
            >
                Relevância
            </option>

            <option
                value="newest"
                @selected(request('sort') === 'newest')
            >
                Mais recentes
            </option>

            <option
                value="price_asc"
                @selected(request('sort') === 'price_asc')
            >
                Menor preço
            </option>

            <option
                value="price_desc"
                @selected(request('sort') === 'price_desc')
            >
                Maior preço
            </option>

        </select>

    </form>

</div>
