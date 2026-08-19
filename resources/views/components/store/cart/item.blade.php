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

    {{-- Imagem --}}
    <a
        href="{{ route('store.books.show', $item->book) }}"
        class="shrink-0"
    >
        @php
            $image = $item->book->images->first();
        @endphp

        @if($image)

            <img
                src="{{ Storage::url($image->image) }}"
                alt="{{ $item->book->title }}"
                class="
                    h-36 w-24
                    rounded-lg object-cover
                "
            >

        @else

            <div
                class="
                    flex h-36 w-24
                    items-center justify-center
                    rounded-lg bg-[#F4F2ED]
                "
            >
                <x-heroicon-o-book-open
                    class="h-9 w-9 text-[#9BA29F]"
                />
            </div>

        @endif

    </a>

    {{-- Informações --}}
    <div class="flex min-w-0 flex-1 flex-col">

        <div class="flex justify-between gap-4">

            <div class="min-w-0">

                {{-- Título --}}
                <a
                    href="{{ route('store.books.show', $item->book) }}"
                    class="
                        line-clamp-2
                        font-semibold text-[#17231F]
                        transition hover:text-[#0D5147]
                    "
                >
                    {{ $item->book->title }}
                </a>

                {{-- Autores --}}
                <p class="mt-1 truncate text-xs text-[#69736F]">
                    {{ $item->book->authors->pluck('name')->join(', ') }}
                </p>

                {{-- Preço unitário --}}
                <p class="mt-3 text-sm font-semibold text-[#17231F]">
                    R$ {{ number_format(
                        $item->unit_price,
                        2,
                        ',',
                        '.'
                    ) }}
                </p>

            </div>

            {{-- Remover --}}
            <form
                action="{{ route('store.cart.destroy', $item) }}"
                method="POST"
                class="shrink-0"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    title="Remover do carrinho"
                    class="
                        flex h-9 w-9
                        items-center justify-center
                        rounded-lg
                        text-[#8A918E]
                        transition
                        hover:bg-red-50
                        hover:text-red-600
                    "
                >
                    <x-heroicon-o-trash class="h-5 w-5" />
                </button>

            </form>

        </div>

        <div
            class="
                mt-auto flex flex-wrap
                items-end justify-between
                gap-4 pt-4
            "
        >

            {{-- Quantidade --}}
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
                        h-10 w-20
                        rounded-lg
                        border border-[#DDDCD7]
                        bg-white
                        text-center text-sm
                        outline-none
                        focus:border-[#0D5147]
                    "
                >

                <button
                    type="submit"
                    class="
                        text-xs font-semibold
                        text-[#315249]
                        transition
                        hover:text-[#062B25]
                    "
                >
                    Atualizar
                </button>

            </form>

            {{-- Subtotal --}}
            <div class="text-right">

                <p class="text-xs text-[#69736F]">
                    Subtotal
                </p>

                <strong class="text-lg text-[#17231F]">
                    R$ {{ number_format(
                        $item->unit_price * $item->quantity,
                        2,
                        ',',
                        '.'
                    ) }}
                </strong>

            </div>

        </div>

    </div>

</article>
