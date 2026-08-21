<header
    x-data="{ searchOpen: false, navigationOpen: false }"
    class="border-b border-[#E8E6E1] bg-[#FCFBF8]"
>

    <div
        class="mx-auto flex h-[88px] max-w-[1440px] items-center gap-1 px-4 sm:h-[102px] sm:gap-4 sm:px-6 lg:gap-8 lg:px-12"
    >

        {{-- Logo --}}
        <a
            href="{{ route('store.home') }}"
            class="shrink-0"
        >

            <div class="tracking-[0.32em]">

                <span class="text-[28px] font-light text-[#062B25] sm:text-[34px]">
                    LUME
                </span>

            </div>

            <p class="mt-[-3px] hidden text-[11px] text-[#53615E] sm:block">
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

        {{-- Busca mobile --}}
        <button
            type="button"
            @click="searchOpen = !searchOpen; navigationOpen = false"
            :aria-expanded="searchOpen"
            aria-label="Abrir busca"
            class="ml-auto rounded-full p-2 transition hover:bg-[#F0EEE8] lg:hidden"
        >
            <x-heroicon-o-magnifying-glass class="h-6 w-6" />
        </button>

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

        {{-- Navegação mobile --}}
        <button
            type="button"
            @click="navigationOpen = !navigationOpen; searchOpen = false"
            :aria-expanded="navigationOpen"
            aria-label="Abrir menu"
            class="rounded-full p-2 transition hover:bg-[#F0EEE8] lg:hidden"
        >
            <x-heroicon-o-bars-3 class="h-7 w-7" />
        </button>

    </div>

    <div
        x-show="searchOpen"
        x-cloak
        x-transition
        class="border-t border-[#E8E6E1] px-5 py-4 lg:hidden"
    >
        <form action="{{ route('store.catalog.index') }}" method="GET" class="mx-auto max-w-xl">
            <div class="relative">
                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Buscar livros, autores ou categorias"
                    class="h-12 w-full rounded-full border border-[#D8D6D0] bg-white px-5 pr-12 text-base focus:border-[#0D5147] focus:ring-[#0D5147]"
                >
                <button type="submit" aria-label="Buscar" class="absolute right-4 top-1/2 -translate-y-1/2">
                    <x-heroicon-o-magnifying-glass class="h-6 w-6" />
                </button>
            </div>
        </form>
    </div>

    <nav
        x-show="navigationOpen"
        x-cloak
        x-transition
        class="border-t border-[#E8E6E1] px-5 py-3 lg:hidden"
    >
        <div class="mx-auto grid max-w-xl gap-1 text-sm font-medium">
            <a href="{{ route('store.catalog.index') }}" class="rounded-lg px-3 py-3 hover:bg-[#F0EEE8]">Catálogo</a>
            <a href="{{ route('store.catalog.index', ['sort' => 'newest']) }}" class="rounded-lg px-3 py-3 hover:bg-[#F0EEE8]">Novidades</a>
            <a href="{{ route('store.catalog.index', ['sort' => 'best_sellers']) }}" class="rounded-lg px-3 py-3 hover:bg-[#F0EEE8]">Mais vendidos</a>
            <a href="{{ route('store.authors.index') }}" class="rounded-lg px-3 py-3 hover:bg-[#F0EEE8]">Autores</a>
            <a href="{{ route('store.catalog.index', ['promotion' => 1]) }}" class="rounded-lg px-3 py-3 hover:bg-[#F0EEE8]">Promoções</a>
        </div>
    </nav>

</header>
