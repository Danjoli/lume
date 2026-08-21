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

    @auth
        <form method="POST" action="{{ route('store.books.reviews.store', $book) }}" class="mt-7 rounded-xl bg-[#F7F6F2] p-5">
            @csrf
            <h3 class="font-semibold text-[#17231F]">Avalie este livro</h3>
            <div class="mt-4 flex gap-3">
                @for($note = 1; $note <= 5; $note++)
                    <label class="cursor-pointer"><input class="sr-only peer" type="radio" name="rating" value="{{ $note }}" @checked(old('rating') == $note)><span class="inline-flex rounded-lg border bg-white px-3 py-2 text-sm peer-checked:border-[#062B25] peer-checked:bg-[#062B25] peer-checked:text-white">{{ $note }} ★</span></label>
                @endfor
            </div>
            <textarea name="comment" rows="4" maxlength="2000" required class="mt-4 w-full rounded-lg border border-[#DDDCD7] p-3 text-sm" placeholder="Conte como foi sua experiência com a leitura...">{{ old('comment') }}</textarea>
            @foreach($errors->all() as $error)<p class="mt-2 text-xs text-red-600">{{ $error }}</p>@endforeach
            <button class="mt-4 rounded-lg bg-[#062B25] px-5 py-2.5 text-sm font-semibold text-white">Enviar avaliação</button>
        </form>
    @else
        <p class="mt-6 rounded-xl bg-[#F7F6F2] p-4 text-sm text-[#69736F]"><a class="font-semibold text-[#062B25]" href="{{ route('login') }}">Entre na sua conta</a> para avaliar este livro.</p>
    @endauth

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
