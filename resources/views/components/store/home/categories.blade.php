@props([
    'categories',
])

<section
    id="categorias"
    class="py-8"
>

    <x-store.ui.container>

        <x-store.ui.section-header
            title="Navegue por categorias"
            :href="route('store.catalog.index')"
        />

        <div
            class="
                grid grid-cols-2 gap-3
                sm:grid-cols-3
                md:grid-cols-5
                xl:grid-cols-9
            "
        >

            @foreach($categories->take(9) as $category)

                <a
                    href="{{ route('store.categories.show', $category) }}"
                    class="
                        group flex min-h-[96px]
                        flex-col items-center justify-center
                        rounded-xl border border-[#E4E2DD]
                        bg-white px-3 py-4 text-center
                        transition
                        hover:border-[#B8C7C2]
                        hover:bg-[#FAFAF7]
                    "
                >

                    <x-heroicon-o-book-open
                        class="
                            mb-3 h-7 w-7
                            text-[#253935]
                            transition group-hover:text-[#062B25]
                        "
                    />

                    <span
                        class="
                            text-xs font-medium leading-4
                            text-[#1C2926]
                        "
                    >
                        {{ $category->name }}
                    </span>

                </a>

            @endforeach

        </div>

    </x-store.ui.container>

</section>
