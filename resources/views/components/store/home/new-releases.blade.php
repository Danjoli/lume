@props([
    'books',
])

<section
    id="novidades"
    class="border-t border-[#ECEAE6] py-10"
>

    <x-store.ui.container>

        <x-store.ui.section-header
            title="Novidades"
            :href="route('store.catalog.index', ['sort' => 'newest'])"
        />

        <div
            class="
                grid grid-cols-2 gap-4
                md:grid-cols-3
                lg:grid-cols-4
                xl:grid-cols-5
            "
        >

            @forelse($books->take(5) as $book)

                <x-store.books.card :book="$book" />

            @empty

                <div
                    class="
                        col-span-full
                        rounded-xl border border-[#E6E4DF]
                        bg-white px-6 py-12
                        text-center
                    "
                >

                    <p class="text-sm text-[#69736F]">
                        Nenhuma novidade disponível no momento.
                    </p>

                </div>

            @endforelse

        </div>

    </x-store.ui.container>

</section>
