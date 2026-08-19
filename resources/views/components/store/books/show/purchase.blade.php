@props([
    'book',
])

<div
    class="
        rounded-2xl border
        border-[#E3E1DB]
        bg-white p-6
    "
>

    <x-store.books.price :book="$book" />

    @if($book->stock > 0)

        <div
            class="
                mt-4 flex items-center gap-2
                text-sm font-medium text-[#286347]
            "
        >
            <span class="h-2 w-2 rounded-full bg-[#286347]"></span>

            Em estoque

            <span class="text-[#7A837F]">
                ({{ $book->stock }} disponíveis)
            </span>
        </div>

    @else

        <p class="mt-4 text-sm font-medium text-red-600">
            Produto indisponível
        </p>

    @endif

    <form
        action="{{ route('store.cart.add') }}"
        method="POST"
        class="mt-6"
    >

        @csrf

        <input
            type="hidden"
            name="book_id"
            value="{{ $book->id }}"
        >

        <div class="flex gap-3">

            <div
                class="
                    flex h-12 items-center
                    rounded-lg border
                    border-[#DDDCD7]
                    bg-white
                "
            >

                <button
                    type="button"
                    class="h-full px-4"
                >
                    −
                </button>

                <input
                    type="number"
                    name="quantity"
                    value="1"
                    min="1"
                    max="{{ $book->stock }}"
                    class="
                        h-full w-12 border-0
                        bg-transparent text-center
                        outline-none
                    "
                >

                <button
                    type="button"
                    class="h-full px-4"
                >
                    +
                </button>

            </div>

            <button
                type="submit"
                @disabled($book->stock <= 0)
                class="
                    flex h-12 flex-1
                    items-center justify-center
                    gap-2 rounded-lg
                    bg-[#062B25]
                    px-6 text-sm
                    font-semibold text-white
                    transition
                    hover:bg-[#0B3C34]
                    disabled:cursor-not-allowed
                    disabled:opacity-50
                "
            >

                <x-heroicon-o-shopping-cart class="h-5 w-5" />

                Adicionar ao carrinho

            </button>

        </div>

    </form>

    <div
        class="
            mt-6 grid gap-3
            border-t border-[#ECEAE6]
            pt-6 sm:grid-cols-2
        "
    >

        <div class="flex items-center gap-3">

            <x-heroicon-o-truck
                class="h-5 w-5 text-[#324740]"
            />

            <span class="text-xs text-[#66716D]">
                Entrega para todo Brasil
            </span>

        </div>

        <div class="flex items-center gap-3">

            <x-heroicon-o-shield-check
                class="h-5 w-5 text-[#324740]"
            />

            <span class="text-xs text-[#66716D]">
                Compra 100% segura
            </span>

        </div>

    </div>

</div>
