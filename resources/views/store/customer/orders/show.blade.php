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

                        @include('store.customer.orders._partials.show.items')

                        @include('store.customer.orders._partials.show.delivery')

                        @include('store.customer.orders._partials.show.shipment')

                    </div>

                    @include('store.customer.orders._partials.show.summary')

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
