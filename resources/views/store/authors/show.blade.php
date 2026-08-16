<x-store.app-layout :title="$author->name">

    <section class="py-10">

        <x-store.ui.container>

            <div
                class="
                    mb-10 rounded-2xl
                    bg-[#F3F2ED] p-8
                "
            >

                <div
                    class="
                        flex flex-col gap-5
                        sm:flex-row sm:items-center
                    "
                >

                    <div
                        class="
                            flex h-20 w-20
                            shrink-0 items-center
                            justify-center
                            rounded-full bg-white
                        "
                    >
                        <x-heroicon-o-user
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
                            Autor
                        </p>

                        <h1
                            class="
                                mt-2 text-3xl
                                font-bold tracking-[-0.03em]
                                text-[#14221E]
                            "
                        >
                            {{ $author->name }}
                        </h1>

                        @if($author->bio)

                            <p
                                class="
                                    mt-3 max-w-3xl
                                    text-sm leading-6
                                    text-[#69736F]
                                "
                            >
                                {{ $author->bio }}
                            </p>

                        @endif

                    </div>

                </div>

            </div>

            <x-store.ui.section-header
                :title="'Livros de ' . $author->name"
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
