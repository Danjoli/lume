<x-admin.guest-layout>

    <div class="flex justify-center mb-6">

        {{-- <a href="{{ route('home') }}">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a> --}}

    </div>

    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('admin.login.store') }}">

        @csrf

        <div>

            <x-input-label
                for="email"
                :value="__('Email')"
            />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

        </div>

        <div class="mt-4">

            <x-input-label
                for="password"
                :value="__('Senha')"
            />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('password')"
            />

        </div>

        <div class="mt-6">

            <x-primary-button class="w-full justify-center">

                Entrar

            </x-primary-button>

        </div>

    </form>

</x-admin.guest-layout>
