<x-store.app-layout title="Novo endereço">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mx-auto max-w-3xl">

                <div class="mb-8">

                    <h1 class="text-3xl font-bold text-[#14221E]">
                        Novo endereço
                    </h1>

                    <p class="mt-2 text-sm text-[#69736F]">
                        Cadastre um novo endereço de entrega.
                    </p>

                </div>

                <form
                    action="{{ route('store.customer.addresses.store') }}"
                    method="POST"
                    class="
                        rounded-2xl border
                        border-[#E5E3DE]
                        bg-white p-6
                    "
                >

                    @csrf

                    @include('store.customer.addresses._form')

                    <div
                        class="
                            mt-7 flex justify-end gap-3
                            border-t border-[#ECEAE6]
                            pt-6
                        "
                    >

                        <x-buttons.secondary-button
                            :href="route(
                                'store.customer.addresses.index'
                            )"
                        >
                            Cancelar
                        </x-buttons.secondary-button>

                        <x-buttons.primary-button type="submit">
                            Salvar endereço
                        </x-buttons.primary-button>

                    </div>

                </form>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
