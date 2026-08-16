<x-store.app-layout title="Categorias">

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
                    Categorias
                </h1>

                <p class="mt-2 text-sm text-[#69736F]">
                    Explore livros por assunto e encontre sua próxima leitura.
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

                @forelse($categories as $category)

                    <a
                        href="{{ route(
                            'store.categories.show',
                            $category
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
                                flex h-11 w-11
                                items-center justify-center
                                rounded-xl bg-[#EEF1ED]
                            "
                        >
                            <x-heroicon-o-tag
                                class="
                                    h-6 w-6
                                    text-[#315249]
                                "
                            />
                        </div>

                        <h2
                            class="
                                mt-5 font-semibold
                                text-[#17231F]
                                group-hover:text-[#0D5147]
                            "
                        >
                            {{ $category->name }}
                        </h2>

                        <p class="mt-2 text-xs text-[#69736F]">

                            {{ $category->books_count }}

                            {{ $category->books_count === 1
                                ? 'livro'
                                : 'livros'
                            }}

                        </p>

                    </a>

                @empty

                    <p class="text-sm text-[#69736F]">
                        Nenhuma categoria disponível.
                    </p>

                @endforelse

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
