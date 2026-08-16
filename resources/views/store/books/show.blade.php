<x-store.app-layout :title="$book->title">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mb-6 text-sm text-[#69736F]">

                <a
                    href="{{ route('store.home') }}"
                    class="hover:text-[#062B25]"
                >
                    Início
                </a>

                <span class="mx-2">/</span>

                <a
                    href="{{ route('store.catalog.index') }}"
                    class="hover:text-[#062B25]"
                >
                    Livros
                </a>

                <span class="mx-2">/</span>

                <span class="text-[#17231F]">
                    {{ $book->title }}
                </span>

            </div>

            <div
                class="
                    grid gap-10
                    lg:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]
                "
            >

                <x-store.books.show.gallery
                    :book="$book"
                />

                <div class="space-y-8">

                    <x-store.books.show.info
                        :book="$book"
                    />

                    <x-store.books.show.purchase
                        :book="$book"
                    />

                </div>

            </div>

            <div class="mt-14 space-y-10">

                <x-store.books.show.description
                    :book="$book"
                />

                <x-store.books.show.details
                    :book="$book"
                />

                <x-store.books.show.reviews
                    :book="$book"
                />

            </div>

            @if($relatedBooks->count())

                <section class="mt-14">

                    <x-store.ui.section-header
                        title="Você também pode gostar"
                        :href="route('store.catalog.index')"
                    />

                    <div
                        class="
                            grid grid-cols-2 gap-4
                            md:grid-cols-3
                            lg:grid-cols-4
                            xl:grid-cols-5
                        "
                    >

                        @foreach($relatedBooks as $relatedBook)

                            <x-store.books.card
                                :book="$relatedBook"
                            />

                        @endforeach

                    </div>

                </section>

            @endif

        </x-store.ui.container>

    </section>

</x-store.app-layout>
