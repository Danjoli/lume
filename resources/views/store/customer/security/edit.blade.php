<x-store.app-layout title="Segurança da conta">

    <section class="py-10 lg:py-14">

        <x-store.ui.container>

            <div class="mx-auto max-w-4xl">

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
                            bg-[#EDF0EC] px-4 py-1.5
                            text-xs font-semibold text-[#233A35]
                        "
                    >
                        Minha conta
                    </span>

                    <h1
                        class="
                            mt-5 text-3xl font-bold
                            tracking-[-0.03em]
                            text-[#10211E]
                            lg:text-4xl
                        "
                    >
                        Segurança
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-[#69736F]">
                        Atualize sua senha para manter sua conta protegida.
                    </p>

                </div>

                <x-alerts.flash />

                <div
                    class="
                        rounded-2xl border border-[#E5E3DE]
                        bg-white p-6 sm:p-8
                    "
                >

                    <div class="mb-7">

                        <div
                            class="
                                flex h-12 w-12 items-center justify-center
                                rounded-xl bg-[#EDF0EC]
                                text-[#315249]
                            "
                        >
                            <x-heroicon-o-lock-closed class="h-6 w-6" />
                        </div>

                        <h2 class="mt-4 text-xl font-bold text-[#17231F]">
                            Alterar senha
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-[#69736F]">
                            Informe sua senha atual e escolha uma nova senha para sua conta.
                        </p>

                    </div>

                    <form
                        action="{{ route('store.customer.security.update') }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <div class="space-y-6">

                            {{-- Senha atual --}}
                            <div>

                                <label
                                    for="current_password"
                                    class="
                                        mb-2 block text-sm font-semibold
                                        text-[#17231F]
                                    "
                                >
                                    Senha atual
                                </label>

                                <input
                                    id="current_password"
                                    type="password"
                                    name="current_password"
                                    autocomplete="current-password"
                                    class="
                                        h-11 w-full rounded-lg
                                        border border-[#DDDCD7]
                                        bg-white px-4 text-sm
                                        text-[#17231F] outline-none
                                        transition
                                        focus:border-[#0D5147]
                                    "
                                >

                                @error('current_password')
                                    <p class="mt-2 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- Nova senha --}}
                            <div>

                                <label
                                    for="password"
                                    class="
                                        mb-2 block text-sm font-semibold
                                        text-[#17231F]
                                    "
                                >
                                    Nova senha
                                </label>

                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    autocomplete="new-password"
                                    class="
                                        h-11 w-full rounded-lg
                                        border border-[#DDDCD7]
                                        bg-white px-4 text-sm
                                        text-[#17231F] outline-none
                                        transition
                                        focus:border-[#0D5147]
                                    "
                                >

                                @error('password')
                                    <p class="mt-2 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- Confirmar nova senha --}}
                            <div>

                                <label
                                    for="password_confirmation"
                                    class="
                                        mb-2 block text-sm font-semibold
                                        text-[#17231F]
                                    "
                                >
                                    Confirmar nova senha
                                </label>

                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    autocomplete="new-password"
                                    class="
                                        h-11 w-full rounded-lg
                                        border border-[#DDDCD7]
                                        bg-white px-4 text-sm
                                        text-[#17231F] outline-none
                                        transition
                                        focus:border-[#0D5147]
                                    "
                                >

                            </div>

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
                                    rounded-lg bg-[#062B25]
                                    px-6 text-sm font-semibold
                                    text-white transition
                                    hover:bg-[#0B3C34]
                                "
                            >
                                Atualizar senha
                            </button>

                        </div>

                    </form>

                </div>

                <div
                    class="
                        mt-6 rounded-2xl
                        bg-[#F2F3EF] p-5
                    "
                >

                    <div class="flex gap-4">

                        <x-heroicon-o-shield-check
                            class="mt-0.5 h-5 w-5 shrink-0 text-[#315249]"
                        />

                        <div>

                            <h2 class="text-sm font-semibold text-[#17231F]">
                                Dica de segurança
                            </h2>

                            <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                Evite reutilizar senhas de outros serviços e escolha
                                uma senha difícil de adivinhar.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
