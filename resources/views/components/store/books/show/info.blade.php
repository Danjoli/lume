@props([
    'book',
])

<div>

    <div class="flex flex-wrap gap-2">

        @foreach($book->categories as $category)

            <a
                href="{{ route('store.catalog.index', [
                    'category' => $category->id
                ]) }}"
                class="
                    rounded-full bg-[#EDF0EC]
                    px-3 py-1
                    text-xs font-semibold
                    text-[#26443C]
                "
            >
                {{ $category->name }}
            </a>

        @endforeach

    </div>

    <h1
        class="
            mt-5 text-3xl font-bold
            leading-tight tracking-[-0.03em]
            text-[#14221E]
            lg:text-4xl
        "
    >
        {{ $book->title }}
    </h1>

    <p class="mt-3 text-sm text-[#65706C]">

        por

        @foreach($book->authors as $author)

            <a
                href="{{ route('store.catalog.index', [
                    'author' => $author->id
                ]) }}"
                class="font-medium text-[#254C43] hover:underline"
            >
                {{ $author->name }}
            </a>

            @if(! $loop->last)
                ,
            @endif

        @endforeach

    </p>

    <x-store.books.rating
        :rating="$book->reviews_avg_rating ?? 0"
        :count="$book->reviews_count ?? 0"
        class="mt-5"
    />

    <p class="mt-6 text-sm leading-6 text-[#606B67]">
        {{ $book->synopsis ?: $book->description }}
    </p>

</div>
