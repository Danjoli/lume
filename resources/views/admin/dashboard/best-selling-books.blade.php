<x-admin.cards.card title="Livros mais vendidos">

    <div class="space-y-5">

        @forelse($bestSellingBooks as $index => $book)
            <div class="flex items-center justify-between">

                <div class="flex min-w-0 items-center gap-4">

                    <span class="w-4 text-sm font-medium text-slate-700">

                        {{ $index + 1 }}

                    </span>

                    <div class="h-[60px] w-[40px] flex-shrink-0 overflow-hidden rounded-md bg-slate-200 shadow-sm">

                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->images->first()->image) }}" alt="{{ $book->title }}"
                                class="h-full w-full object-cover">
                        @endif

                    </div>

                    <div class="min-w-0">

                        <h3 class="truncate text-base font-semibold text-slate-900">

                            {{ $book->title }}

                        </h3>

                        <p class="truncate text-sm text-slate-500">

                            {{ $book->authors->first()?->name ?? 'Sem autor' }}

                        </p>

                    </div>

                </div>

                <span class="ml-6 text-base font-medium text-slate-900">

                    {{ number_format($book->sale_price) }}

                </span>

            </div>

        @empty

            <p class="py-8 text-center text-sm text-slate-500">

                Nenhum livro vendido até o momento.

            </p>
        @endforelse

    </div>

    <div class="mt-6">

        <a href="{{ route('admin.books.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-indigo-600 transition hover:text-indigo-700">

            Ver todos os livros

            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>

        </a>

    </div>

</x-admin.cards.card>
