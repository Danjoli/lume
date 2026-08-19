<x-store.app-layout title="Editar perfil">

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
                        Dados pessoais
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-[#69736F]">
                        Atualize as informações utilizadas na sua conta e durante
                        suas compras na Lume.
                    </p>

                </div>

                <x-alerts.flash />

                <div
                    class="
                        rounded-2xl border border-[#E5E3DE]
                        bg-white p-6 sm:p-8
                    "
                >

                    <form
                        action="{{ route('store.customer.profile.update') }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <div class="grid gap-6 sm:grid-cols-2">

                            {{-- Nome --}}
                            <div class="sm:col-span-2">

                                <label
                                    for="name"
                                    class="
                                        mb-2 block text-sm font-semibold
                                        text-[#17231F]
                                    "
                                >
                                    Nome completo
                                </label>

                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    autocomplete="name"
                                    class="
                                        h-11 w-full rounded-lg
                                        border border-[#DDDCD7]
                                        bg-white px-4 text-sm
                                        text-[#17231F] outline-none
                                        transition
                                        focus:border-[#0D5147]
                                    "
                                >

                                @error('name')
                                    <p class="mt-2 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- E-mail --}}
                            <div>

                                <label
                                    for="email"
                                    class="
                                        mb-2 block text-sm font-semibold
                                        text-[#17231F]
                                    "
                                >
                                    E-mail
                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    autocomplete="email"
                                    class="
                                        h-11 w-full rounded-lg
                                        border border-[#DDDCD7]
                                        bg-white px-4 text-sm
                                        text-[#17231F] outline-none
                                        transition
                                        focus:border-[#0D5147]
                                    "
                                >

                                @error('email')
                                    <p class="mt-2 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- Telefone --}}
                            <div>

                                <label
                                    for="phone"
                                    class="
                                        mb-2 block text-sm font-semibold
                                        text-[#17231F]
                                    "
                                >
                                    Telefone
                                </label>

                                <input
                                    id="phone"
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                    autocomplete="tel"
                                    placeholder="(11) 99999-9999"
                                    class="
                                        h-11 w-full rounded-lg
                                        border border-[#DDDCD7]
                                        bg-white px-4 text-sm
                                        text-[#17231F] outline-none
                                        transition
                                        placeholder:text-[#A0A5A2]
                                        focus:border-[#0D5147]
                                    "
                                >

                                @error('phone')
                                    <p class="mt-2 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                        @if($user->isDirty('email'))
                            <p class="mt-5 text-xs text-[#69736F]">
                                Ao alterar seu e-mail, poderá ser necessária uma
                                nova verificação do endereço informado.
                            </p>
                        @endif

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
                                Salvar alterações
                            </button>

                        </div>

                    </form>

                </div>

                <div
                    class="
                        mt-6 flex items-start gap-4
                        rounded-2xl bg-[#F2F3EF]
                        p-5
                    "
                >
                    <x-heroicon-o-information-circle
                        class="mt-0.5 h-5 w-5 shrink-0 text-[#315249]"
                    />

                    <div>

                        <h2 class="text-sm font-semibold text-[#17231F]">
                            Segurança da conta
                        </h2>

                        <p class="mt-1 text-sm leading-6 text-[#69736F]">
                            Para alterar sua senha, acesse a página de segurança.
                        </p>

                        <a
                            href="{{ route('store.customer.security.edit') }}"
                            class="
                                mt-2 inline-flex text-sm font-semibold
                                text-[#315249] transition
                                hover:text-[#062B25]
                            "
                        >
                            Alterar senha
                        </a>

                    </div>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>

