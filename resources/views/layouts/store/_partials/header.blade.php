<header class="border-b border-[#E8E6E1] bg-[#FCFBF8]">

    <div
        class="mx-auto flex h-[102px] max-w-[1440px] items-center gap-8 px-6 lg:px-12"
    >

        {{-- Logo --}}
        <a
            href="{{ route('store.home') }}"
            class="shrink-0"
        >

            <div class="tracking-[0.32em]">

                <span class="text-[34px] font-light text-[#062B25]">
                    LUME
                </span>

            </div>

            <p class="mt-[-3px] text-[11px] text-[#53615E]">
                Livros que iluminam ideias
            </p>

        </a>

        {{-- Navegação --}}
        <nav
            class="ml-auto hidden items-center gap-9 text-sm font-medium lg:flex"
        >

            <a
                href="{{ route('store.catalog.index') }}"
                class="flex items-center gap-1 transition hover:text-[#0D5147]"
            >
                Categorias

                <x-heroicon-o-chevron-down class="h-4 w-4" />
            </a>

            <a
                href="{{ route('store.catalog.index', ['sort' => 'newest']) }}"
                class="transition hover:text-[#0D5147]"
            >
                Novidades
            </a>

            <a
                href="{{ route('store.catalog.index', ['sort' => 'best_sellers']) }}"
                class="transition hover:text-[#0D5147]"
            >
                Mais Vendidos
            </a>

            <a
                href="{{ route('store.authors.index') }}"
                class="transition hover:text-[#0D5147]"
            >
                Autores
            </a>

            <a
                href="{{ route('store.catalog.index', ['promotion' => 1]) }}"
                class="transition hover:text-[#0D5147]"
            >
                Promoções
            </a>

        </nav>

        {{-- Busca --}}
        <form
            action="{{ route('store.catalog.index') }}"
            method="GET"
            class="hidden w-[285px] xl:block"
        >

            <div class="relative">

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Buscar livros, autores, categorias..."
                    class="
                        h-11 w-full rounded-full border border-[#DDDCD7]
                        bg-white px-5 pr-12 text-sm outline-none
                        placeholder:text-[#9A9D9B]
                        focus:border-[#0D5147]
                    "
                >

                <button
                    type="submit"
                    class="
                        absolute right-4 top-1/2
                        -translate-y-1/2 text-[#101816]
                    "
                >
                    <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                </button>

            </div>

        </form>

        {{-- Conta --}}
        <x-store.profile.menu />

        {{-- Carrinho --}}
        <a
            href="{{ route('store.cart.index') }}"
            class="relative"
        >

            <x-heroicon-o-shopping-cart class="h-7 w-7" />

            @if (($cartCount ?? 0) > 0)
                <span
                    class="
                        absolute -right-2 -top-2
                        flex h-5 min-w-5 items-center justify-center
                        rounded-full bg-[#062B25] px-1
                        text-[10px] font-bold text-white
                    "
                >
                    {{ min($cartCount, 99) }}
                </span>
            @endif
        </a>

    </div>

</header>
