<x-store.app-layout :title="'Pedido #' . $order->id">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mx-auto max-w-5xl">

                <div
                    class="
                        mb-8 flex flex-col gap-4
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                >

                    <div>

                        <div class="flex flex-wrap items-center gap-3">

                            <h1
                                class="
                                    text-3xl font-bold
                                    tracking-[-0.03em]
                                    text-[#14221E]
                                "
                            >
                                Pedido #{{ $order->id }}
                            </h1>

                            <x-badges.status-badge
                                :status="$order->status"
                            />

                        </div>

                        <p class="mt-2 text-sm text-[#69736F]">

                            Realizado em

                            {{ $order->created_at->format('d/m/Y H:i') }}

                        </p>

                    </div>

                    <a
                        href="{{ route('store.customer.orders.index') }}"
                        class="
                            inline-flex h-10
                            items-center justify-center
                            rounded-lg border
                            border-[#DDDCD7]
                            px-4 text-sm
                            font-semibold text-[#35433F]
                        "
                    >
                        Voltar
                    </a>

                </div>

                <div
                    class="
                        grid gap-6
                        lg:grid-cols-[minmax(0,1fr)_340px]
                    "
                >

                    <div class="space-y-6">

                        {{-- Itens --}}

                        <section
                            class="
                                rounded-2xl border
                                border-[#E5E3DE]
                                bg-white p-6
                            "
                        >

                            <h2 class="text-lg font-bold text-[#17231F]">
                                Itens do pedido
                            </h2>

                            <div class="mt-6 divide-y divide-[#ECEAE6]">

                                @foreach($order->items as $item)

                                    <div
                                        class="
                                            flex gap-4 py-5
                                            first:pt-0
                                            last:pb-0
                                        "
                                    >

                                        @if($item->book?->primaryImage)

                                            <img
                                                src="{{ Storage::url(
                                                    $item->book->primaryImage->image
                                                ) }}"
                                                alt="{{ $item->title }}"
                                                class="
                                                    h-24 w-16
                                                    shrink-0 rounded-md
                                                    object-cover
                                                "
                                            >

                                        @else

                                            <div
                                                class="
                                                    flex h-24 w-16
                                                    shrink-0 items-center
                                                    justify-center rounded-md
                                                    bg-[#F4F2ED]
                                                "
                                            >
                                                <x-heroicon-o-book-open
                                                    class="
                                                        h-7 w-7
                                                        text-[#9BA29F]
                                                    "
                                                />
                                            </div>

                                        @endif

                                        <div class="min-w-0 flex-1">

                                            <p
                                                class="
                                                    font-medium
                                                    text-[#17231F]
                                                "
                                            >
                                                {{ $item->title }}
                                            </p>

                                            <p
                                                class="
                                                    mt-2 text-sm
                                                    text-[#69736F]
                                                "
                                            >
                                                Quantidade:
                                                {{ $item->quantity }}
                                            </p>

                                            <p
                                                class="
                                                    mt-1 text-sm
                                                    text-[#69736F]
                                                "
                                            >
                                                Unitário:
                                                R$
                                                {{ number_format(
                                                    $item->price,
                                                    2,
                                                    ',',
                                                    '.'
                                                ) }}
                                            </p>

                                        </div>

                                        <strong class="text-sm text-[#17231F]">

                                            R$

                                            {{ number_format(
                                                $item->subtotal,
                                                2,
                                                ',',
                                                '.'
                                            ) }}

                                        </strong>

                                    </div>

                                @endforeach

                            </div>

                        </section>

                        {{-- Entrega --}}

                        <section
                            class="
                                rounded-2xl border
                                border-[#E5E3DE]
                                bg-white p-6
                            "
                        >

                            <h2 class="text-lg font-bold text-[#17231F]">
                                Endereço de entrega
                            </h2>

                            <div class="mt-5 text-sm leading-6 text-[#69736F]">

                                <p class="font-medium text-[#35433F]">
                                    {{ $order->recipient_name }}
                                </p>

                                <p class="mt-2">

                                    {{ $order->street }},
                                    {{ $order->number }}

                                    @if($order->complement)
                                        — {{ $order->complement }}
                                    @endif

                                </p>

                                <p>
                                    {{ $order->neighborhood }}
                                </p>

                                <p>
                                    {{ $order->city }}/{{ $order->state }}
                                </p>

                                <p>
                                    CEP {{ $order->cep }}
                                </p>

                                <p class="mt-2">
                                    {{ $order->phone }}
                                </p>

                            </div>

                        </section>

                        {{-- Envio --}}

                        @if($order->shipment)

                            <section
                                class="
                                    rounded-2xl border
                                    border-[#E5E3DE]
                                    bg-white p-6
                                "
                            >

                                <h2 class="text-lg font-bold text-[#17231F]">
                                    Entrega
                                </h2>

                                <dl
                                    class="
                                        mt-5 grid gap-5
                                        sm:grid-cols-2
                                    "
                                >

                                    <div>

                                        <dt class="text-xs text-[#69736F]">
                                            Transportadora
                                        </dt>

                                        <dd
                                            class="
                                                mt-1 text-sm
                                                font-medium text-[#17231F]
                                            "
                                        >
                                            {{ $order->shipment->carrier ?: '-' }}
                                        </dd>

                                    </div>

                                    <div>

                                        <dt class="text-xs text-[#69736F]">
                                            Código de rastreio
                                        </dt>

                                        <dd
                                            class="
                                                mt-1 text-sm
                                                font-medium text-[#17231F]
                                            "
                                        >
                                            {{ $order->shipment->tracking_code ?: '-' }}
                                        </dd>

                                    </div>

                                </dl>

                            </section>

                        @endif

                    </div>

                    {{-- Resumo --}}

                    <aside
                        class="
                            h-fit rounded-2xl
                            border border-[#E5E3DE]
                            bg-white p-6
                        "
                    >

                        <h2 class="text-lg font-bold text-[#17231F]">
                            Resumo
                        </h2>

                        <dl class="mt-6 space-y-4">

                            <div class="flex justify-between text-sm">

                                <dt class="text-[#69736F]">
                                    Subtotal
                                </dt>

                                <dd class="font-medium text-[#17231F]">

                                    R$
                                    {{ number_format(
                                        $order->subtotal,
                                        2,
                                        ',',
                                        '.'
                                    ) }}

                                </dd>

                            </div>

                            <div class="flex justify-between text-sm">

                                <dt class="text-[#69736F]">
                                    Frete
                                </dt>

                                <dd class="font-medium text-[#17231F]">

                                    R$
                                    {{ number_format(
                                        $order->shipping,
                                        2,
                                        ',',
                                        '.'
                                    ) }}

                                </dd>

                            </div>

                            <div class="flex justify-between text-sm">

                                <dt class="text-[#69736F]">
                                    Desconto
                                </dt>

                                <dd class="font-medium text-[#17231F]">

                                    - R$
                                    {{ number_format(
                                        $order->discount,
                                        2,
                                        ',',
                                        '.'
                                    ) }}

                                </dd>

                            </div>

                            <div
                                class="
                                    flex justify-between
                                    border-t border-[#ECEAE6]
                                    pt-5
                                "
                            >

                                <dt class="font-semibold text-[#17231F]">
                                    Total
                                </dt>

                                <dd
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >

                                    R$
                                    {{ number_format(
                                        $order->total,
                                        2,
                                        ',',
                                        '.'
                                    ) }}

                                </dd>

                            </div>

                        </dl>

                        <div
                            class="
                                mt-6 border-t
                                border-[#ECEAE6]
                                pt-5
                            "
                        >

                            <p class="text-xs text-[#69736F]">
                                Status do pagamento
                            </p>

                            <div class="mt-2">

                                <x-badges.status-badge
                                    :status="$order->payment_status"
                                />

                            </div>

                        </div>

                    </aside>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
