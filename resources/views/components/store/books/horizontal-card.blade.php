@props([
    'book',
    'position' => null,
])

@php
    $inCart = ($cartBookIds ?? collect())
        ->contains((int) $book->id);

    $inWishlist = ($wishlistBookIds ?? collect())
        ->contains((int) $book->id);
@endphp

<article
    class="
        relative flex min-w-0 gap-4
        rounded-xl border border-[#E6E4DF]
        bg-white p-3
        transition
        hover:border-[#CFCBC4]
        hover:shadow-sm
    "
>

    {{-- Posição no ranking --}}
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

    {{-- Lista de desejos --}}
    @if($inWishlist)

        <form
            action="{{ route('store.wishlist.destroy', $book) }}"
            method="POST"
            class="absolute right-3 top-3 z-20"
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
                    hover:border-[#D86666]
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
            class="absolute right-3 top-3 z-20"
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

    {{-- Imagem --}}
    <a
        href="{{ route('store.books.show', $book) }}"
        class="shrink-0"
    >

        <img
            src="{{ $book->images->first()
                ? Storage::url($book->images->first()->image)
                : asset('images/store/book-placeholder.jpg') }}"
            alt="{{ $book->title }}"
            class="
                h-[168px] w-[108px]
                rounded-md object-cover
            "
        >

    </a>

    {{-- Informações --}}
    <div class="flex min-w-0 flex-1 flex-col py-2">

        {{-- Título --}}
        <a
            href="{{ route('store.books.show', $book) }}"
            class="
                line-clamp-2 pr-8
                font-semibold leading-5
                text-[#18231F]
                hover:text-[#0D5147]
            "
        >
            {{ $book->title }}
        </a>

        {{-- Autor --}}
        <p class="mt-1 truncate pr-6 text-xs text-[#69736F]">
            {{ $book->authors->pluck('name')->join(', ') }}
        </p>

        {{-- Avaliação --}}
        <x-store.books.rating
            :rating="$book->reviews_avg_rating ?? 0"
            :count="$book->reviews_count ?? 0"
            class="mt-5"
        />

        {{-- Preço e carrinho --}}
        <div class="mt-auto flex items-end justify-between gap-2">

            <x-store.books.price :book="$book" />

            <form
                action="{{ route('store.cart.toggle') }}"
                method="POST"
                class="shrink-0"
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

                        // Livro no carrinho
                        'border-[#062B25] bg-[#062B25] text-white
                         hover:bg-[#0B3C34]' => $inCart,

                        // Livro fora do carrinho
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
