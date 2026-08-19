<x-store.app-layout title="Excluir conta">

    <section class="py-10 lg:py-14">

        <x-store.ui.container>

            <div class="mx-auto max-w-3xl">

                <div class="mb-8">

                    <a
                        href="{{ route('store.customer.profile.index') }}"
                        class="
                            inline-flex items-center gap-2
                            text-sm font-semibold
                            text-[#315249]
                            transition hover:text-[#062B25]
                        "
                    >
                        <x-heroicon-o-arrow-left class="h-4 w-4" />

                        Voltar para minha conta
                    </a>

                    <span
                        class="
                            mt-6 inline-flex rounded-full
                            bg-red-50 px-4 py-1.5
                            text-xs font-semibold text-red-700
                        "
                    >
                        Área crítica
                    </span>

                    <h1
                        class="
                            mt-5 text-3xl font-bold
                            tracking-[-0.03em]
                            text-[#10211E]
                            lg:text-4xl
                        "
                    >
                        Excluir conta
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-[#69736F]">
                        Excluir sua conta removerá seu acesso à Lume.
                        Confirme sua senha para continuar.
                    </p>

                </div>

                <x-alerts.flash />

                <div
                    class="
                        rounded-2xl border border-red-200
                        bg-white p-6 sm:p-8
                    "
                >

                    <div class="flex gap-4">

                        <div
                            class="
                                flex h-12 w-12 shrink-0 items-center justify-center
                                rounded-xl bg-red-50 text-red-600
                            "
                        >
                            <x-heroicon-o-exclamation-triangle class="h-6 w-6" />
                        </div>

                        <div>

                            <h2 class="text-xl font-bold text-[#17231F]">
                                Esta ação não pode ser desfeita
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-[#69736F]">
                                Depois que sua conta for excluída, você não poderá
                                mais acessar seus dados pela área do cliente.
                            </p>

                        </div>

                    </div>

                    <div
                        class="
                            mt-7 rounded-xl
                            bg-[#F7F6F2] p-5
                        "
                    >

                        <h3 class="text-sm font-semibold text-[#17231F]">
                            Antes de excluir sua conta
                        </h3>

                        <ul
                            class="
                                mt-4 space-y-3
                                text-sm leading-6 text-[#69736F]
                            "
                        >

                            <li class="flex gap-3">

                                <x-heroicon-o-check-circle
                                    class="mt-0.5 h-5 w-5 shrink-0 text-[#69736F]"
                                />

                                <span>
                                    Verifique se não há pedidos em andamento.
                                </span>

                            </li>

                            <li class="flex gap-3">

                                <x-heroicon-o-check-circle
                                    class="mt-0.5 h-5 w-5 shrink-0 text-[#69736F]"
                                />

                                <span>
                                    Certifique-se de que não precisa consultar
                                    informações importantes da sua conta.
                                </span>

                            </li>

                        </ul>

                    </div>

                    <form
                        action="{{ route('store.customer.account.destroy') }}"
                        method="POST"
                        class="mt-8"
                    >
                        @csrf
                        @method('DELETE')

                        <div>

                            <label
                                for="password"
                                class="
                                    mb-2 block text-sm font-semibold
                                    text-[#17231F]
                                "
                            >
                                Confirme sua senha
                            </label>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                autocomplete="current-password"
                                placeholder="Digite sua senha atual"
                                class="
                                    h-11 w-full rounded-lg
                                    border border-[#DDDCD7]
                                    bg-white px-4 text-sm
                                    text-[#17231F] outline-none
                                    transition
                                    placeholder:text-[#A0A5A2]
                                    focus:border-red-400
                                "
                            >

                            @error('password')
                                <p class="mt-2 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div
                            class="
                                mt-8 flex flex-col-reverse gap-3
                                border-t border-[#ECEAE6]
                                pt-6 sm:flex-row
                                sm:items-center sm:justify-end
                            "
                        >

                            <a
                                href="{{ route('store.customer.profile.index') }}"
                                class="
                                    inline-flex h-11 items-center justify-center
                                    rounded-lg border border-[#DDDCD7]
                                    bg-white px-6 text-sm font-semibold
                                    text-[#394844] transition
                                    hover:bg-[#F7F6F2]
                                "
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="
                                    inline-flex h-11 items-center justify-center
                                    rounded-lg bg-red-600
                                    px-6 text-sm font-semibold
                                    text-white transition
                                    hover:bg-red-700
                                "
                            >
                                Excluir minha conta
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>

