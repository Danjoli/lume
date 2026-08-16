<x-store.app-layout title="Checkout">

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
                    Finalizar compra
                </h1>

                <p class="mt-2 text-sm text-[#69736F]">
                    Confira seus dados antes de finalizar o pedido.
                </p>

            </div>

            <x-alerts.flash />

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

                    <div class="space-y-6">

                        <x-store.checkout.address
                            :addresses="$addresses"
                        />

                        <x-store.checkout.items
                            :cart="$cart"
                        />

                    </div>

                    <div>

                        <x-store.checkout.summary
                            :cart="$cart"
                        />

                    </div>

                </div>

            </form>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
