<x-admin.guest-layout>

    <div class="mb-6 flex justify-center">

        <a
            href="{{ route('store.home') }}"
            class="
                text-3xl
                font-bold
                tracking-[-0.04em]
                text-[#062B25]
                transition-opacity
                duration-200
                hover:opacity-80
            "
        >
            Lume
        </a>

    </div>

    <x-auth.auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login.store') }}">

        @csrf

        <div>

            <x-forms.label for="email" :value="__('Email')" />

            <x-forms.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />

            <x-forms.error
                field="email"
            />

        </div>

        <div class="mt-4">

            <x-forms.label for="password" :value="__('Senha')" />

            <x-forms.input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-forms.error
                field="password"
            />

        </div>

        <div class="mt-6">

            <x-buttons.primary-button
                type="submit"
                class="w-full justify-center">

                Entrar

            </x-buttons.primary-button>

        </div>

        <a class="block text-center text-sm font-semibold text-slate-600 hover:text-slate-900" href="{{ route('admin.password.request') }}">Esqueci minha senha</a>
    </form>

</x-admin.guest-layout>
