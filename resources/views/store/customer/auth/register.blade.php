<x-store.app-layout title="Criar conta">

    <section class="py-14">

        <x-store.ui.container>

            <div class="mx-auto max-w-lg">

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
                                text-[#17231F]
                            "
                        >
                            Crie sua conta
                        </h1>

                        <p class="mt-2 text-sm text-[#69736F]">
                            Cadastre-se para comprar e acompanhar seus pedidos.
                        </p>

                    </div>

                    <form
                        method="POST"
                        action="{{ route('register') }}"
                        class="mt-8 space-y-5"
                    >

                        @csrf

                        <div>

                            <x-forms.label for="name">
                                Nome
                            </x-forms.label>

                            <x-forms.input
                                id="name"
                                name="name"
                                type="text"
                                :value="old('name')"
                                required
                                autofocus
                            />

                            <x-forms.error field="name" />

                        </div>

                        <div>

                            <x-forms.label for="email">
                                E-mail
                            </x-forms.label>

                            <x-forms.input
                                id="email"
                                name="email"
                                type="email"
                                :value="old('email')"
                                required
                            />

                            <x-forms.error field="email" />

                        </div>

                        <div>

                            <x-forms.label for="password">
                                Senha
                            </x-forms.label>

                            <x-forms.input
                                id="password"
                                name="password"
                                type="password"
                                required
                            />

                            <x-forms.error field="password" />

                        </div>

                        <div>

                            <x-forms.label for="password_confirmation">
                                Confirmar senha
                            </x-forms.label>

                            <x-forms.input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                            />

                        </div>

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
                            Criar conta
                        </button>

                    </form>

                    <p class="mt-7 text-center text-sm text-[#69736F]">

                        Já possui conta?

                        <a
                            href="{{ route('login') }}"
                            class="
                                font-semibold
                                text-[#315249]
                                hover:underline
                            "
                        >
                            Entrar
                        </a>

                    </p>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
