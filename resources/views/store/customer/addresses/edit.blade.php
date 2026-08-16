<x-store.app-layout title="Editar endereço">

    <section class="py-10">

        <x-store.ui.container>

            <div class="mx-auto max-w-3xl">

                <div class="mb-8">

                    <h1 class="text-3xl font-bold text-[#14221E]">
                        Editar endereço
                    </h1>

                    <p class="mt-2 text-sm text-[#69736F]">
                        Atualize as informações do endereço.
                    </p>

                </div>

                <form
                    action="{{ route(
                        'store.customer.addresses.update',
                        $address
                    ) }}"
                    method="POST"
                    class="
                        rounded-2xl border
                        border-[#E5E3DE]
                        bg-white p-6
                    "
                >

                    @csrf
                    @method('PUT')

                    @include(
                        'store.customer.addresses._form',
                        ['address' => $address]
                    )

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
                            Salvar alterações
                        </x-buttons.primary-button>

                    </div>

                </form>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
