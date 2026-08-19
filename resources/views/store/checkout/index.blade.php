<x-store.app-layout title="Checkout">

    <section class="py-10 lg:py-14">

        <x-store.ui.container>

            {{-- Cabeçalho --}}
            <div class="mb-8">

                <span
                    class="
                        inline-flex rounded-full
                        bg-[#EDF0EC] px-4 py-1.5
                        text-xs font-semibold text-[#233A35]
                    "
                >
                    Checkout
                </span>

                <h1
                    class="
                        mt-5 text-3xl font-bold
                        tracking-[-0.03em]
                        text-[#14221E]
                        lg:text-4xl
                    "
                >
                    Finalizar compra
                </h1>

                <p
                    class="
                        mt-2 max-w-2xl
                        text-sm leading-6 text-[#69736F]
                    "
                >
                    Escolha o endereço, a forma de entrega e o pagamento
                    antes de confirmar seu pedido.
                </p>

            </div>

            <x-alerts.flash />

            {{-- Erro relacionado ao carrinho --}}
            @if($errors->has('cart'))

                <div
                    class="
                        mb-6 rounded-xl
                        border border-red-200
                        bg-red-50 p-4
                        text-sm text-red-700
                    "
                >
                    {{ $errors->first('cart') }}
                </div>

            @endif

            {{-- Formulário principal --}}
            <form
                action="{{ route('store.checkout.store') }}"
                method="POST"
            >
                @csrf

                <div
                    class="
                        grid gap-8
                        lg:grid-cols-[minmax(0,1fr)_380px]
                    "
                >

                    {{-- Etapas do checkout --}}
                    <div class="space-y-5">

                        {{-- 1. Endereço --}}
                        <x-store.checkout.address
                            :addresses="$addresses"
                        />

                        {{-- 2. Dados do pedido --}}
                        <x-store.checkout.customer-data />

                        {{-- 3. Frete --}}
                        <x-store.checkout.shipping
                            :shipping-options="$shippingOptions ?? collect()"
                        />

                        {{-- 4. Pagamento --}}
                        <x-store.checkout.payment />

                        {{-- 5. Revisão dos produtos --}}
                        <x-store.checkout.items
                            :cart="$cart"
                        />

                    </div>

                    {{-- Resumo --}}
                    <div>

                        <div class="lg:sticky lg:top-6">

                            <x-store.checkout.summary
                                :cart="$cart"
                                :shipping-price="$shippingPrice ?? 0"
                            />

                        </div>

                    </div>

                </div>

            </form>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
