<x-store.app-layout :title="$publisher->name">

    <section class="py-10">

        <x-store.ui.container>

            <div
                class="
                    mb-10 rounded-2xl
                    bg-[#F3F2ED] p-8
                "
            >

                <div class="flex items-center gap-5">

                    <div
                        class="
                            flex h-20 w-20
                            shrink-0 items-center
                            justify-center
                            rounded-2xl bg-white
                        "
                    >

                        <x-heroicon-o-building-office-2
                            class="h-9 w-9 text-[#315249]"
                        />

                    </div>

                    <div>

                        <p
                            class="
                                text-xs font-semibold
                                uppercase tracking-[0.15em]
                                text-[#69736F]
                            "
                        >
                            Editora
                        </p>

                        <h1
                            class="
                                mt-2 text-3xl
                                font-bold tracking-[-0.03em]
                                text-[#14221E]
                            "
                        >
                            {{ $publisher->name }}
                        </h1>

                    </div>

                </div>

            </div>

            <x-store.ui.section-header
                :title="'Livros da ' . $publisher->name"
            />

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
