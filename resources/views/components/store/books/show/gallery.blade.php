@props([
    'book',
])

<div class="grid gap-4 md:grid-cols-[80px_minmax(0,1fr)]">

    <div class="order-2 flex gap-3 md:order-1 md:flex-col">

        @foreach($book->images as $image)

            <button
                type="button"
                class="
                    overflow-hidden rounded-lg
                    border border-[#E2E0DA]
                    bg-white p-1
                    transition
                    hover:border-[#062B25]
                "
            >

                <img
                    src="{{ Storage::url($image->image) }}"
                    alt="{{ $book->title }}"
                    class="h-20 w-14 object-cover"
                >

            </button>

        @endforeach

    </div>

    <div
        class="
            order-1 flex min-h-[520px]
            items-center justify-center
            rounded-2xl
            bg-[#F5F3EE]
            p-8
            md:order-2
        "
    >

        @if($book->images->first())

            <img
                src="{{ Storage::url($book->images->first()->image) }}"
                alt="{{ $book->title }}"
                class="
                    max-h-[520px]
                    max-w-full
                    object-contain
                "
            >

        @else

            <x-heroicon-o-book-open
                class="h-20 w-20 text-[#A2A8A5]"
            />

        @endif

    </div>

</div>
