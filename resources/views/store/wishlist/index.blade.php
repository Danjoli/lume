<x-store.app-layout title="Lista de desejos">

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
                    Lista de desejos
                </h1>

                <p class="mt-2 text-sm text-[#69736F]">
                    Salve livros para consultar ou comprar depois.
                </p>

            </div>

            <x-alerts.flash />

            @if($wishlist->count())

                <div
                    class="
                        grid grid-cols-2 gap-4
                        md:grid-cols-3
                        lg:grid-cols-4
                        xl:grid-cols-5
                    "
                >

                    @foreach($wishlist as $item)

                        <x-store.wishlist.item
                            :item="$item"
                        />

                    @endforeach

                </div>

            @else

                <x-store.wishlist.empty />

            @endif

        </x-store.ui.container>

    </section>

</x-store.app-layout>
