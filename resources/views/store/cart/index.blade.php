@props([
    'book',
])

<section
    class="
        rounded-2xl border
        border-[#E5E3DE]
        bg-white p-7
    "
>

    <div class="flex items-center justify-between">

        <div>

            <h2 class="text-xl font-bold text-[#17231F]">
                Avaliações
            </h2>

            <x-store.books.rating
                :rating="$book->reviews_avg_rating ?? 0"
                :count="$book->reviews_count ?? 0"
                class="mt-2"
            />

        </div>

    </div>

    <div class="mt-7 divide-y divide-[#ECEAE6]">

        @forelse($book->reviews as $review)

            <article class="py-6 first:pt-0">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-[#192722]">
                            {{ $review->user->name }}
                        </p>

                        <div class="mt-2 flex text-[#E9A512]">

                            @for($i = 1; $i <= 5; $i++)

                                @if($i <= $review->rating)

                                    <x-heroicon-s-star class="h-4 w-4" />

                                @else

                                    <x-heroicon-o-star class="h-4 w-4" />

                                @endif

                            @endfor

                        </div>

                    </div>

                    <span class="text-xs text-[#8A918E]">
                        {{ $review->created_at->format('d/m/Y') }}
                    </span>

                </div>

                @if($review->comment)

                    <p
                        class="
                            mt-4 text-sm
                            leading-6 text-[#606B67]
                        "
                    >
                        {{ $review->comment }}
                    </p>

                @endif

            </article>

        @empty

            <div class="py-10 text-center">

                <p class="text-sm text-[#69736F]">
                    Este livro ainda não possui avaliações.
                </p>

            </div>

        @endforelse

    </div>

</section>
