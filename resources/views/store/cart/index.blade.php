<x-store.app-layout title="Carrinho">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-[#14221E]">
                    Meu carrinho
                </h1>

                <p class="mt-2 text-sm text-[#69736F]">
                    Revise seus livros antes de finalizar a compra.
                </p>

            </div>

            <x-alerts.flash />

            @if($cart && $cart->items->isNotEmpty())

                @php
                    $subtotal = $cart->items->sum(
                        fn ($item) =>
                            $item->unit_price * $item->quantity
                    );
                @endphp

                <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_340px]">

                    <div class="space-y-4">

                        @foreach($cart->items as $item)

                            <x-store.cart.item
                                :item="$item"
                            />

                        @endforeach

                    </div>

                    <aside
                        class="
                            h-fit rounded-2xl
                            border border-[#E5E3DE]
                            bg-white p-6
                            lg:sticky lg:top-6
                        "
                    >

                        <h2 class="text-lg font-bold text-[#17231F]">
                            Resumo
                        </h2>

                        <div
                            class="
                                mt-5 flex items-end justify-between
                                border-b border-[#ECEAE6]
                                pb-5
                            "
                        >

                            <span class="text-sm text-[#69736F]">
                                Subtotal
                            </span>

                            <strong class="text-xl text-[#17231F]">
                                R$ {{ number_format(
                                    $subtotal,
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </strong>

                        </div>

                        <div class="mt-5 flex items-start gap-3">

                            <x-heroicon-o-truck
                                class="
                                    mt-0.5 h-5 w-5 shrink-0
                                    text-[#315249]
                                "
                            />

                            <p class="text-xs leading-5 text-[#69736F]">
                                O frete será calculado na próxima etapa
                                de acordo com o endereço de entrega.
                            </p>

                        </div>

                        <a
                            href="{{ route('store.checkout.index') }}"
                            class="
                                mt-6 flex h-11
                                items-center justify-center
                                rounded-lg
                                bg-[#062B25]
                                text-sm font-semibold
                                text-white
                                transition
                                hover:bg-[#0B3C34]
                            "
                        >
                            Finalizar compra
                        </a>

                        <a
                            href="{{ route('store.catalog.index') }}"
                            class="
                                mt-3 flex h-10
                                items-center justify-center
                                text-sm font-semibold
                                text-[#315249]
                                transition
                                hover:text-[#062B25]
                            "
                        >
                            Continuar comprando
                        </a>

                    </aside>

                </div>

            @else

                <div
                    class="
                        flex min-h-[360px]
                        flex-col items-center
                        justify-center
                        rounded-2xl
                        border border-[#E5E3DE]
                        bg-white p-8
                        text-center
                    "
                >

                    <x-heroicon-o-shopping-cart
                        class="h-10 w-10 text-[#8D9894]"
                    />

                    <h2 class="mt-4 font-semibold text-[#17231F]">
                        Seu carrinho está vazio
                    </h2>

                    <p class="mt-2 text-sm text-[#69736F]">
                        Adicione livros ao carrinho para continuar.
                    </p>

                    <a
                        href="{{ route('store.catalog.index') }}"
                        class="
                            mt-5 inline-flex h-11
                            items-center justify-center
                            rounded-lg bg-[#062B25]
                            px-6 text-sm font-semibold
                            text-white
                            transition
                            hover:bg-[#0B3C34]
                        "
                    >
                        Explorar livros
                    </a>

                </div>

            @endif

        </x-store.ui.container>

    </section>

</x-store.app-layout>
