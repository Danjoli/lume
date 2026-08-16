@props([
    'item',
])

<article
    class="
        flex gap-5 rounded-2xl
        border border-[#E5E3DE]
        bg-white p-5
    "
>

    <a
        href="{{ route('store.books.show', $item->book) }}"
        class="shrink-0"
    >

        @if($item->book->primaryImage)

            <img
                src="{{ Storage::url($item->book->primaryImage->image) }}"
                alt="{{ $item->book->title }}"
                class="h-36 w-24 rounded-lg object-cover"
            >

        @else

            <div
                class="
                    flex h-36 w-24 items-center justify-center
                    rounded-lg bg-[#F4F2ED]
                "
            >
                <x-heroicon-o-book-open class="h-9 w-9 text-[#9BA29F]" />
            </div>

        @endif

    </a>

    <div class="flex min-w-0 flex-1 flex-col">

        <div class="flex justify-between gap-4">

            <div>

                <a
                    href="{{ route('store.books.show', $item->book) }}"
                    class="font-semibold text-[#17231F] hover:text-[#0D5147]"
                >
                    {{ $item->book->title }}
                </a>

                <p class="mt-1 text-xs text-[#69736F]">
                    {{ $item->book->authors->pluck('name')->join(', ') }}
                </p>

            </div>

            <form
                action="{{ route('store.cart.destroy', $item) }}"
                method="POST"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    title="Remover"
                    class="text-[#8A918E] transition hover:text-red-600"
                >
                    <x-heroicon-o-trash class="h-5 w-5" />
                </button>

            </form>

        </div>

        <div class="mt-auto flex flex-wrap items-end justify-between gap-4">

            <form
                action="{{ route('store.cart.update', $item) }}"
                method="POST"
                class="flex items-center gap-3"
            >

                @csrf
                @method('PATCH')

                <label
                    for="quantity-{{ $item->id }}"
                    class="text-xs text-[#69736F]"
                >
                    Quantidade
                </label>

                <input
                    id="quantity-{{ $item->id }}"
                    type="number"
                    name="quantity"
                    min="1"
                    max="{{ $item->book->stock }}"
                    value="{{ $item->quantity }}"
                    class="
                        h-10 w-20 rounded-lg
                        border border-[#DDDCD7]
                        text-center text-sm
                    "
                    onchange="this.form.submit()"
                >

            </form>

            <div class="text-right">

                <p class="text-xs text-[#69736F]">
                    Subtotal
                </p>

                <strong class="text-lg text-[#17231F]">
                    R$
                    {{ number_format(
                        $item->quantity * $item->unit_price,
                        2,
                        ',',
                        '.'
                    ) }}
                </strong>

            </div>

        </div>

    </div>

</article>
