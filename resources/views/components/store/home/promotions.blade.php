@props([
    'books',
])

<section
    id="promocoes"
    class="bg-[#F6F5F1] py-12"
>

    <x-store.ui.container>

        <div class="mb-7">

            <span
                class="
                    inline-flex rounded-full
                    bg-[#E7ECE8] px-3 py-1
                    text-xs font-semibold text-[#21453D]
                "
            >
                Ofertas especiais
            </span>

            <div class="mt-3 flex items-end justify-between">

                <div>

                    <h2
                        class="
                            text-2xl font-bold tracking-[-0.02em]
                            text-[#13211F]
                        "
                    >
                        Livros em promoção
                    </h2>

                    <p class="mt-1 text-sm text-[#69736F]">
                        Boas histórias por preços ainda melhores.
                    </p>

                </div>

                <a
                    href="{{ route('store.catalog.index', ['promotion' => 1]) }}"
                    class="
                        hidden items-center gap-1
                        text-sm font-medium text-[#43514D]
                        hover:text-[#062B25]
                        sm:flex
                    "
                >
                    Ver todos

                    <x-heroicon-o-chevron-right class="h-4 w-4" />
                </a>

            </div>

        </div>

        <div
            class="
                grid grid-cols-2 gap-4
                md:grid-cols-3
                lg:grid-cols-4
                xl:grid-cols-5
            "
        >

            @forelse($books->take(5) as $book)

                <x-store.books.card :book="$book" />

            @empty

                <div
                    class="
                        col-span-full rounded-xl
                        border border-[#E2E0DA]
                        bg-white px-6 py-12 text-center
                    "
                >

                    <p class="text-sm text-[#69736F]">
                        Nenhuma promoção disponível no momento.
                    </p>

                </div>

            @endforelse

        </div>

    </x-store.ui.container>

</section>
