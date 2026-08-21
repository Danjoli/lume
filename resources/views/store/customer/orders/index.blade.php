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
                                    transition
                                    hover:border-[#CBC8C1]
                                    hover:shadow-sm
                                "
                            >

                                {{-- Cabeçalho --}}
                                <div
                                    class="
                                        flex flex-col gap-4
                                        sm:flex-row
                                        sm:items-start
                                        sm:justify-between
                                    "
                                >

                                    <div>

                                        <div class="flex flex-wrap items-center gap-3">

                                            <h2
                                                class="
                                                    text-lg font-semibold
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
                                            {{ $order->created_at->format('d/m/Y \à\s H:i') }}
                                        </p>

                                    </div>

                                    <a
                                        href="{{ route(
                                            'store.customer.orders.show',
                                            $order
                                        ) }}"
                                        class="
                                            inline-flex h-10
                                            shrink-0 items-center justify-center
                                            gap-2 rounded-lg border
                                            border-[#DDDCD7]
                                            px-4 text-sm
                                            font-semibold text-[#35433F]
                                            transition
                                            hover:bg-[#F7F6F2]
                                        "
                                    >
                                        Ver pedido

                                        <x-heroicon-o-chevron-right
                                            class="h-4 w-4"
                                        />
                                    </a>

                                </div>

                                {{-- Conteúdo --}}
                                <div
                                    class="
                                        mt-5 grid gap-6
                                        border-t border-[#ECEAE6]
                                        pt-5
                                        lg:grid-cols-[minmax(0,1fr)_420px]
                                    "
                                >

                                    {{-- Itens --}}
                                    <div>

                                        <div class="flex items-center gap-4">

                                            <div class="flex -space-x-3">

                                                @foreach($order->items->take(3) as $item)

                                                    @php
                                                        $image = $item->book?->primaryImage;
                                                    @endphp

                                                    <div
                                                        class="
                                                            relative h-16 w-11
                                                            overflow-hidden
                                                            rounded-md border-2
                                                            border-white
                                                            bg-[#F4F2ED]
                                                        "
                                                    >

                                                        @php
                                                            $image = $item->book->images->first();
                                                        @endphp

                                                        @if($image)

                                                            <img
                                                                src="{{ Storage::url($image->image) }}"
                                                                alt="{{ $item->title }}"
                                                                class="h-full w-full object-cover"
                                                            >

                                                        @else

                                                            <div
                                                                class="
                                                                    flex h-full w-full
                                                                    items-center justify-center
                                                                "
                                                            >
                                                                <x-heroicon-o-book-open
                                                                    class="h-5 w-5 text-[#9BA29F]"
                                                                />
                                                            </div>

                                                        @endif

                                                    </div>

                                                @endforeach

                                            </div>

                                            <div>

                                                <p class="text-sm font-semibold text-[#17231F]">
                                                    {{ $order->items_count }}
                                                    {{ $order->items_count === 1
                                                        ? 'livro'
                                                        : 'livros'
                                                    }}
                                                </p>

                                                @if($order->items_count > 3)

                                                    <p class="mt-1 text-xs text-[#69736F]">
                                                        + {{ $order->items_count - 3 }}
                                                        {{ ($order->items_count - 3) === 1
                                                            ? 'outro item'
                                                            : 'outros itens'
                                                        }}
                                                    </p>

                                                @else

                                                    <p class="mt-1 text-xs text-[#69736F]">
                                                        Itens deste pedido
                                                    </p>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                    {{-- Informações --}}
                                    <div
                                        class="
                                            grid grid-cols-2 gap-5
                                            sm:grid-cols-3
                                        "
                                    >

                                        {{-- Pagamento --}}
                                        <div>

                                            <p
                                                class="
                                                    text-xs font-medium
                                                    text-[#8A918E]
                                                "
                                            >
                                                Pagamento
                                            </p>

                                            <p
                                                class="
                                                    mt-1 text-sm font-semibold
                                                    text-[#17231F]
                                                "
                                            >
                                                {{ $order->payment_method->label() }}
                                            </p>

                                            <p class="mt-1 text-xs text-[#69736F]">
                                                {{ $order->payment_status->value }}
                                            </p>

                                        </div>

                                        {{-- Entrega --}}
                                        <div>

                                            <p
                                                class="
                                                    text-xs font-medium
                                                    text-[#8A918E]
                                                "
                                            >
                                                Entrega
                                            </p>

                                            <p
                                                class="
                                                    mt-1 text-sm font-semibold
                                                    text-[#17231F]
                                                "
                                            >
                                                @if($order->shipment)

                                                    {{ match($order->shipment->status->value) {
                                                        'pending' => 'Pendente',
                                                        'preparing' => 'Preparando',
                                                        'shipped' => 'Enviado',
                                                        'delivered' => 'Entregue',
                                                        'returned' => 'Devolvido',
                                                        'cancelled' => 'Cancelado',
                                                        default => ucfirst($order->shipment->status->value),
                                                    } }}

                                                @else

                                                    Aguardando

                                                @endif
                                            </p>

                                            @if($order->shipment?->service)

                                                <p class="mt-1 text-xs text-[#69736F]">
                                                    {{ $order->shipment->service }}
                                                </p>

                                            @endif

                                        </div>

                                        {{-- Total --}}
                                        <div>

                                            <p
                                                class="
                                                    text-xs font-medium
                                                    text-[#8A918E]
                                                "
                                            >
                                                Total
                                            </p>

                                            <strong
                                                class="
                                                    mt-1 block
                                                    text-lg text-[#17231F]
                                                "
                                            >
                                                R$ {{ number_format(
                                                    $order->total,
                                                    2,
                                                    ',',
                                                    '.'
                                                ) }}
                                            </strong>

                                        </div>

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
                                transition
                                hover:bg-[#0B3C34]
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
