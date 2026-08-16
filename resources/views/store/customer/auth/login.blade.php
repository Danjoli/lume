<x-store.app-layout title="Entrar">

    <section class="py-14">

        <x-store.ui.container>

            <div class="mx-auto max-w-md">

                <div
                    class="
                        rounded-2xl
                        border border-[#E5E3DE]
                        bg-white p-8
                    "
                >

                    <div class="text-center">

                        <h1
                            class="
                                text-2xl font-bold
                                tracking-[-0.02em]
                                text-[#17231F]
                            "
                        >
                            Entre na sua conta
                        </h1>

                        <p class="mt-2 text-sm text-[#69736F]">
                            Acesse seus pedidos, endereços e favoritos.
                        </p>

                    </div>

                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="mt-8 space-y-5"
                    >

                        @csrf

                        <div>

                            <x-forms.label for="email">
                                E-mail
                            </x-forms.label>

                            <x-forms.input
                                id="email"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <x-forms.error field="email" />

                        </div>

                        <div>

                            <div class="flex items-center justify-between">

                                <x-forms.label for="password">
                                    Senha
                                </x-forms.label>

                                @if(Route::has('password.request'))

                                    <a
                                        href="{{ route('password.request') }}"
                                        class="
                                            text-xs font-medium
                                            text-[#315249]
                                            hover:underline
                                        "
                                    >
                                        Esqueci minha senha
                                    </a>

                                @endif

                            </div>

                            <x-forms.input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                            />

                            <x-forms.error field="password" />

                        </div>

                        <label class="flex items-center gap-2">

                            <input
                                type="checkbox"
                                name="remember"
                                class="
                                    rounded border-[#D8D6D0]
                                    text-[#062B25]
                                    focus:ring-[#062B25]
                                "
                            >

                            <span class="text-sm text-[#69736F]">
                                Manter conectado
                            </span>

                        </label>

                        <button
                            type="submit"
                            class="
                                flex h-12 w-full
                                items-center justify-center
                                rounded-lg bg-[#062B25]
                                text-sm font-semibold
                                text-white transition
                                hover:bg-[#0B3C34]
                            "
                        >
                            Entrar
                        </button>

                    </form>

                    <div
                        class="
                            mt-7 border-t
                            border-[#ECEAE6]
                            pt-6 text-center
                        "
                    >

                        <p class="text-sm text-[#69736F]">
                            Ainda não possui conta?

                            <a
                                href="{{ route('register') }}"
                                class="
                                    font-semibold
                                    text-[#315249]
                                    hover:underline
                                "
                            >
                                Criar conta
                            </a>
                        </p>

                    </div>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
