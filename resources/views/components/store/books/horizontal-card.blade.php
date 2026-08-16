@props([
    'book',
    'position' => null,
])

<article
    class="
        relative flex min-w-0 gap-4
        rounded-xl border border-[#E6E4DF]
        bg-white p-3
        transition hover:border-[#CFCBC4]
        hover:shadow-sm
    "
>

    @if($position)

        <span
            class="
                absolute -left-1 -top-1 z-10
                flex h-6 w-6 items-center justify-center
                rounded-full bg-[#D99A08]
                text-xs font-bold text-white
            "
        >
            {{ $position }}
        </span>

    @endif

    <a
        href="{{ route('store.books.show', $book) }}"
        class="shrink-0"
    >

        <img
            src="{{ $book->primaryImage
                ? Storage::url($book->primaryImage->image)
                : asset('images/store/book-placeholder.jpg') }}"
            alt="{{ $book->title }}"
            class="
                h-[168px] w-[108px]
                rounded-md object-cover
            "
        >

    </a>

    <div class="flex min-w-0 flex-1 flex-col py-2">

        <a
            href="{{ route('store.books.show', $book) }}"
            class="font-semibold text-[#18231F] hover:underline"
        >
            {{ $book->title }}
        </a>

        <p class="mt-1 truncate text-xs text-[#69736F]">
            {{ $book->authors->pluck('name')->join(', ') }}
        </p>

        <x-store.books.rating
            :rating="$book->reviews_avg_rating ?? 0"
            :count="$book->reviews_count ?? 0"
            class="mt-5"
        />

        <div class="mt-auto flex items-end justify-between">

            <x-store.books.price :book="$book" />

            <button
                type="button"
                class="
                    flex h-9 w-9 items-center justify-center
                    rounded-lg border border-[#E0DED9]
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
