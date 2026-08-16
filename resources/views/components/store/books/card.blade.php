@props([
    'book',
])

<article
    class="
        group flex h-full flex-col
        rounded-xl border border-[#E6E4DF]
        bg-white p-4
        transition
        hover:border-[#CBC8C1]
        hover:shadow-sm
    "
>

    <a
        href="{{ route('store.books.show', $book) }}"
        class="relative block overflow-hidden rounded-lg bg-[#F5F3EE]"
    >

        @if($book->sale_price)

            <span
                class="
                    absolute left-3 top-3 z-10
                    rounded-full bg-[#062B25]
                    px-3 py-1
                    text-[11px] font-semibold text-white
                "
            >
                Oferta
            </span>

        @endif

        <img
            src="{{ $book->primaryImage
                ? Storage::url($book->primaryImage->image)
                : asset('images/store/book-placeholder.jpg') }}"
            alt="{{ $book->title }}"
            class="
                mx-auto h-[260px] w-full
                object-contain p-4
                transition duration-300
                group-hover:scale-[1.03]
            "
        >

    </a>

    <div class="flex flex-1 flex-col pt-4">

        <a
            href="{{ route('store.books.show', $book) }}"
            class="
                line-clamp-2
                text-sm font-semibold leading-5
                text-[#17231F]
                hover:text-[#0D5147]
            "
        >
            {{ $book->title }}
        </a>

        <p class="mt-1 truncate text-xs text-[#69736F]">
            {{ $book->authors->pluck('name')->join(', ') }}
        </p>

        <x-store.books.rating
            :rating="$book->reviews_avg_rating ?? 0"
            :count="$book->reviews_count ?? 0"
            class="mt-3"
        />

        <div class="mt-auto flex items-end justify-between pt-5">

            <x-store.books.price :book="$book" />

            <button
                type="button"
                title="Adicionar ao carrinho"
                class="
                    flex h-9 w-9 items-center justify-center
                    rounded-lg border border-[#E0DED9]
                    text-[#18231F]
                    transition
                    hover:border-[#062B25]
                    hover:bg-[#062B25]
                    hover:text-white
                "
            >
                <x-heroicon-o-shopping-cart class="h-5 w-5" />
            </button>

        </div>

    </div>

</article>
