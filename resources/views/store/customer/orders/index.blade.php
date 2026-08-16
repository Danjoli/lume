<x-store.app-layout title="Meus pedidos">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mx-auto max-w-5xl">

                <div class="mb-8">

                    <h1
                        class="
                            text-3xl font-bold
                            tracking-[-0.03em]
                            text-[#14221E]
                        "
                    >
                        Meus pedidos
                    </h1>

                    <p class="mt-2 text-sm text-[#69736F]">
                        Acompanhe suas compras e o andamento das entregas.
                    </p>

                </div>

                <x-alerts.flash />

                @if($orders->count())

                    <div class="space-y-4">

                        @foreach($orders as $order)

                            <article
                                class="
                                    rounded-2xl border
                                    border-[#E5E3DE]
                                    bg-white p-6
                                "
                            >

                                <div
                                    class="
                                        flex flex-col gap-5
                                        sm:flex-row
                                        sm:items-center
                                        sm:justify-between
                                    "
                                >

                                    <div>

                                        <div class="flex flex-wrap items-center gap-3">

                                            <h2
                                                class="
                                                    font-semibold
                                                    text-[#17231F]
                                                "
                                            >
                                                Pedido #{{ $order->id }}
                                            </h2>

                                            <x-badges.status-badge
                                                :status="$order->status"
                                            />

                                        </div>

                                        <p class="mt-2 text-sm text-[#69736F]">

                                            Realizado em

                                            {{ $order->created_at->format('d/m/Y H:i') }}

                                        </p>

                                        <p class="mt-1 text-sm text-[#69736F]">

                                            {{ $order->items_count }}

                                            {{ $order->items_count === 1
                                                ? 'item'
                                                : 'itens'
                                            }}

                                        </p>

                                    </div>

                                    <div
                                        class="
                                            flex items-center gap-6
                                            sm:text-right
                                        "
                                    >

                                        <div>

                                            <p class="text-xs text-[#69736F]">
                                                Total
                                            </p>

                                            <strong
                                                class="
                                                    mt-1 block
                                                    text-lg text-[#17231F]
                                                "
                                            >
                                                R$
                                                {{ number_format(
                                                    $order->total,
                                                    2,
                                                    ',',
                                                    '.'
                                                ) }}
                                            </strong>

                                        </div>

                                        <a
                                            href="{{ route(
                                                'store.customer.orders.show',
                                                $order
                                            ) }}"
                                            class="
                                                inline-flex h-10
                                                items-center justify-center
                                                rounded-lg border
                                                border-[#DDDCD7]
                                                px-4 text-sm
                                                font-semibold text-[#35433F]
                                                transition
                                                hover:bg-[#F7F6F2]
                                            "
                                        >
                                            Ver pedido
                                        </a>

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                    <div class="mt-8">
                        {{ $orders->links() }}
                    </div>

                @else

                    <div
                        class="
                            flex min-h-[390px]
                            flex-col items-center
                            justify-center
                            rounded-2xl border
                            border-[#E5E3DE]
                            bg-white p-8
                            text-center
                        "
                    >

                        <div
                            class="
                                flex h-16 w-16
                                items-center justify-center
                                rounded-full bg-[#EEF1ED]
                            "
                        >
                            <x-heroicon-o-shopping-bag
                                class="h-8 w-8 text-[#335048]"
                            />
                        </div>

                        <h2
                            class="
                                mt-5 text-xl
                                font-bold text-[#17231F]
                            "
                        >
                            Você ainda não fez nenhum pedido
                        </h2>

                        <p
                            class="
                                mt-2 max-w-md
                                text-sm leading-6
                                text-[#69736F]
                            "
                        >
                            Quando você realizar uma compra,
                            poderá acompanhar tudo por aqui.
                        </p>

                        <a
                            href="{{ route('store.catalog.index') }}"
                            class="
                                mt-6 inline-flex h-11
                                items-center justify-center
                                rounded-lg bg-[#062B25]
                                px-6 text-sm
                                font-semibold text-white
                            "
                        >
                            Explorar livros
                        </a>

                    </div>

                @endif

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
