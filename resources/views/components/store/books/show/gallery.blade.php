@props([
    'book',
])

@php
    $images = $book->images
        ->map(fn ($image) => [
            'url' => Storage::url($image->image),
            'alt' => $book->title,
        ])
        ->values();
@endphp

<div
    x-data="{
        images: @js($images),
        selected: 0,
    }"
    class="grid gap-4 md:grid-cols-[80px_minmax(0,1fr)]"
>

    <div class="order-2 flex gap-3 overflow-x-auto pb-1 md:order-1 md:flex-col md:overflow-visible">

        @foreach($book->images as $index => $image)

            <button
                type="button"
                @click="selected = {{ $index }}"
                :aria-pressed="selected === {{ $index }}"
                :class="selected === {{ $index }} ? 'border-[#062B25] ring-2 ring-[#062B25]/15' : 'border-[#E2E0DA]'"
                class="
                    shrink-0 overflow-hidden rounded-lg
                    border
                    bg-white p-1
                    transition
                    hover:border-[#062B25]
                "
            >

                <img
                    src="{{ Storage::url($image->image) }}"
                    alt="Miniatura {{ $index + 1 }} de {{ $book->title }}"
                    class="h-20 w-14 object-cover"
                >

            </button>

        @endforeach

    </div>

    <div
        class="
            order-1 flex min-h-[360px]
            items-center justify-center
            rounded-2xl
            bg-[#F5F3EE]
            p-5 sm:min-h-[440px] sm:p-8 lg:min-h-[520px]
            md:order-2
        "
    >

        @if($book->images->first())

            <img
                :src="images[selected].url"
                :alt="images[selected].alt"
                class="
                    max-h-[340px] sm:max-h-[430px] lg:max-h-[520px]
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
