<div
    class="
        flex min-h-[430px]
        flex-col items-center justify-center
        rounded-2xl border
        border-[#E5E3DE]
        bg-white px-6 text-center
    "
>

    <div
        class="
            flex h-16 w-16 items-center justify-center
            rounded-full bg-[#EEF1ED]
        "
    >
        <x-heroicon-o-shopping-cart
            class="h-8 w-8 text-[#335048]"
        />
    </div>

    <h2 class="mt-5 text-xl font-bold text-[#17231F]">
        Seu carrinho está vazio
    </h2>

    <p class="mt-2 max-w-md text-sm leading-6 text-[#69736F]">
        Explore nosso catálogo e encontre sua próxima leitura.
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
        Explorar livros
    </a>

</div>
