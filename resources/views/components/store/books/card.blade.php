@props([
    'book',
])

@php
    $inCart = ($cartBookIds ?? collect())->contains($book->id);
    $inWishlist = ($wishlistBookIds ?? collect())->contains($book->id);
@endphp

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

    <div class="relative">

        <a
            href="{{ route('store.books.show', $book) }}"
            class="block overflow-hidden rounded-lg bg-[#F5F3EE]"
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
                src="{{ $book->images->first()
                    ? Storage::url($book->images->first()->image)
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

        {{-- Lista de desejos --}}
        @if($inWishlist)

            <form
                action="{{ route('store.wishlist.destroy', $book) }}"
                method="POST"
                class="absolute -right-2 -top-2 z-20"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    title="Remover da lista de desejos"
                    class="
                        flex h-8 w-8 items-center justify-center
                        rounded-full
                        border border-[#E7B5B5]
                        bg-white
                        text-[#D86666]
                        shadow-sm
                        transition
                        hover:bg-[#FFF5F5]
                        hover:text-[#C94F4F]
                    "
                >
                    <x-heroicon-s-heart
                        class="h-4 w-4 fill-current"
                    />
                </button>

            </form>

        @else

            <form
                action="{{ route('store.wishlist.store', $book) }}"
                method="POST"
                class="absolute -right-2 -top-2 z-20"
            >
                @csrf

                <button
                    type="submit"
                    title="Adicionar à lista de desejos"
                    class="
                        flex h-8 w-8 items-center justify-center
                        rounded-full
                        border border-[#E7B5B5]
                        bg-white
                        text-[#D86666]
                        shadow-sm
                        transition
                        hover:border-[#D86666]
                        hover:bg-[#FFF5F5]
                        hover:text-[#C94F4F]
                    "
                >
                    <x-heroicon-o-heart class="h-4 w-4" />
                </button>

            </form>

        @endif

    </div>

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

            <form
                action="{{ route('store.cart.toggle') }}"
                method="POST"
            >
                @csrf

                <input
                    type="hidden"
                    name="book_id"
                    value="{{ $book->id }}"
                >

                <button
                    type="submit"
                    title="{{ $inCart
                        ? 'Remover do carrinho'
                        : ($book->stock > 0
                            ? 'Adicionar ao carrinho'
                            : 'Livro indisponível') }}"
                    @disabled($book->stock <= 0 && !$inCart)
                    @class([
                        'flex h-9 w-9 items-center justify-center',
                        'rounded-lg border transition',
                        'disabled:cursor-not-allowed disabled:opacity-40',

                        'border-[#062B25] bg-[#062B25] text-white
                         hover:bg-[#0B3C34]' => $inCart,

                        'border-[#E0DED9] bg-white text-[#18231F]
                         hover:border-[#062B25]
                         hover:bg-[#F2F5F3]
                         hover:text-[#062B25]' => !$inCart,
                    ])
                >
                    <x-heroicon-o-shopping-cart class="h-5 w-5" />
                </button>

            </form>

        </div>

    </div>

</article>
