<div
    class="
        mt-6 flex min-h-[350px]
        flex-col items-center justify-center
        rounded-xl border border-[#E6E4DF]
        bg-white px-6 text-center
    "
>

    <x-heroicon-o-book-open
        class="h-12 w-12 text-[#9BA29F]"
    />

    <h2
        class="
            mt-4 text-lg font-semibold
            text-[#17231F]
        "
    >
        Nenhum livro encontrado
    </h2>

    <p
        class="
            mt-2 max-w-md
            text-sm leading-6 text-[#69736F]
        "
    >
        Tente alterar os filtros ou buscar por outro
        título, autor ou categoria.
    </p>

    <a
        href="{{ route('store.catalog.index') }}"
        class="
            mt-6 inline-flex h-11
            items-center justify-center
            rounded-lg bg-[#062B25]
            px-6 text-sm font-semibold
            text-white
        "
    >
        Limpar filtros
    </a>

</div>
