<x-store.app-layout :title="$category->name">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mb-8">

                <div class="text-sm text-[#69736F]">

                    <a
                        href="{{ route('store.home') }}"
                        class="hover:text-[#062B25]"
                    >
                        Início
                    </a>

                    <span class="mx-2">/</span>

                    <a
                        href="{{ route('store.categories.index') }}"
                        class="hover:text-[#062B25]"
                    >
                        Categorias
                    </a>

                    <span class="mx-2">/</span>

                    <span class="text-[#17231F]">
                        {{ $category->name }}
                    </span>

                </div>

                <h1
                    class="
                        mt-5 text-3xl
                        font-bold tracking-[-0.03em]
                        text-[#14221E]
                    "
                >
                    {{ $category->name }}
                </h1>

                @if($category->description)

                    <p
                        class="
                            mt-2 max-w-2xl
                            text-sm leading-6
                            text-[#69736F]
                        "
                    >
                        {{ $category->description }}
                    </p>

                @endif

            </div>

            <div
                class="
                    mb-6 flex items-center
                    justify-between
                    border-b border-[#E7E5E0]
                    pb-5
                "
            >

                <p class="text-sm text-[#69736F]">

                    <strong class="text-[#17231F]">
                        {{ $books->total() }}
                    </strong>

                    livros encontrados

                </p>

                <form method="GET">

                    <select
                        name="sort"
                        onchange="this.form.submit()"
                        class="
                            h-10 rounded-lg
                            border border-[#DDDCD7]
                            bg-white px-3 text-sm
                        "
                    >

                        <option
                            value=""
                            @selected(! request('sort'))
                        >
                            Mais recentes
                        </option>

                        <option
                            value="price_asc"
                            @selected(
                                request('sort') === 'price_asc'
                            )
                        >
                            Menor preço
                        </option>

                        <option
                            value="price_desc"
                            @selected(
                                request('sort') === 'price_desc'
                            )
                        >
                            Maior preço
                        </option>

                    </select>

                </form>

            </div>

            @if($books->count())

                <div
                    class="
                        grid grid-cols-2 gap-4
                        md:grid-cols-3
                        lg:grid-cols-4
                        xl:grid-cols-5
                    "
                >

                    @foreach($books as $book)

                        <x-store.books.card
                            :book="$book"
                        />

                    @endforeach

                </div>

                <div class="mt-10">
                    {{ $books->links() }}
                </div>

            @else

                <x-store.catalog.empty />

            @endif

        </x-store.ui.container>

    </section>

</x-store.app-layout>
