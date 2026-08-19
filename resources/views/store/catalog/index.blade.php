<x-store.app-layout title="Livros">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mb-8">

                <p
                    class="
                        text-xs font-semibold uppercase
                        tracking-[0.15em]
                        text-[#61706B]
                    "
                >
                    Catálogo
                </p>

                <h1
                    class="
                        mt-2 text-3xl font-bold
                        tracking-[-0.025em]
                        text-[#12211D]
                    "
                >
                    Encontre sua próxima leitura
                </h1>

                <p class="mt-2 text-sm text-[#69736F]">
                    Explore todos os livros disponíveis na Lume.
                </p>

            </div>

            <div
                class="
                    grid gap-8
                    lg:grid-cols-[260px_minmax(0,1fr)]
                "
            >

                <aside>

                    <x-store.catalog.filters
                        :categories="$categories"
                        :authors="$authors"
                        :publishers="$publishers"
                    />

                </aside>

                <div>

                    <x-store.catalog.toolbar
                        :books="$books"
                    />

                    @if($books->count())

                        <div
                            class="
                                mt-6 grid grid-cols-2 gap-4
                                md:grid-cols-3
                                xl:grid-cols-4
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

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>

