@props([
    'books',
])

<section
    id="mais-vendidos"
    class="pb-10"
>

    <x-store.ui.container>

        <x-store.ui.section-header
            title="Mais vendidos"
            :href="route('store.catalog.index', ['sort' => 'best_sellers'])"
        />

        <div class="grid gap-3 lg:grid-cols-2 xl:grid-cols-5">

            @foreach($books->take(5) as $book)

                <x-store.books.horizontal-card
                    :book="$book"
                    :position="$loop->iteration <= 3
                        ? $loop->iteration
                        : null"
                />

            @endforeach

        </div>

    </x-store.ui.container>

</section>
