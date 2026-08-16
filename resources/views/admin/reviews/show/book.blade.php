<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Livro

    </h2>

    <div class="space-y-5">

        @if ($review->book->cover)
            <img src="{{ Storage::url($review->book->cover) }}" alt="{{ $review->book->title }}"
                class="mx-auto h-52 rounded-xl border object-cover">
        @endif

        <dl class="space-y-4">

            <div>

                <dt>Título</dt>

                <dd>

                    {{ $review->book->title }}

                </dd>

            </div>

            <div>

                <dt>ISBN</dt>

                <dd>

                    {{ $review->book->isbn }}

                </dd>

            </div>

            <div>

                <dt>Editora</dt>

                <dd>

                    {{ $review->book->publisher?->name }}

                </dd>

            </div>

        </dl>

    </div>

</x-admin.cards.card>
