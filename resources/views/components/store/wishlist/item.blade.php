@props([
    'item',
])

<div class="relative">

    <x-store.books.card
        :book="$item->book"
    />

    <form
        action="{{ route(
            'store.wishlist.destroy',
            $item->book
        ) }}"
        method="POST"
        class="absolute right-3 top-3 z-20"
    >

        @csrf
        @method('DELETE')

        <button
            type="submit"
            title="Remover da lista"
            class="
                flex h-9 w-9
                items-center justify-center
                rounded-full
                border border-[#E0DED9]
                bg-white
                text-red-600
                shadow-sm
                transition
                hover:bg-red-50
            "
        >
            <x-heroicon-o-heart class="h-5 w-5" />
        </button>

    </form>

</div>
