<x-store.app-layout title="Autores">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mb-8">

                <h1
                    class="
                        text-3xl font-bold
                        tracking-[-0.03em]
                        text-[#14221E]
                    "
                >
                    Autores
                </h1>

                <p class="mt-2 text-sm text-[#69736F]">
                    Descubra livros através dos seus autores favoritos.
                </p>

            </div>

            <div
                class="
                    grid gap-4
                    sm:grid-cols-2
                    md:grid-cols-3
                    lg:grid-cols-4
                "
            >

                @forelse($authors as $author)

                    <a
                        href="{{ route(
                            'store.authors.show',
                            $author
                        ) }}"
                        class="
                            group rounded-2xl
                            border border-[#E5E3DE]
                            bg-white p-6
                            transition
                            hover:border-[#9BAEA8]
                        "
                    >

                        <div
                            class="
                                flex h-12 w-12
                                items-center justify-center
                                rounded-full bg-[#EEF1ED]
                            "
                        >
                            <x-heroicon-o-user
                                class="h-6 w-6 text-[#315249]"
                            />
                        </div>

                        <h2
                            class="
                                mt-5 font-semibold
                                text-[#17231F]
                                group-hover:text-[#0D5147]
                            "
                        >
                            {{ $author->name }}
                        </h2>

                        <p class="mt-2 text-xs text-[#69736F]">

                            {{ $author->books_count }}

                            {{ $author->books_count === 1
                                ? 'livro'
                                : 'livros'
                            }}

                        </p>

                    </a>

                @empty

                    <p class="text-sm text-[#69736F]">
                        Nenhum autor encontrado.
                    </p>

                @endforelse

            </div>

            <div class="mt-10">
                {{ $authors->links() }}
            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
