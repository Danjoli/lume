<x-customer.guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-forms.label for="email" :value="__('Email')" />
            <x-forms.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required
                autofocus autocomplete="username" />
            <x-forms.input :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-forms.label for="password" :value="__('Password')" />
            <x-forms.input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-forms.input :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-forms.label for="password_confirmation" :value="__('Confirm Password')" />

            <x-forms.input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-forms.input :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-buttons.primary-button>
                {{ __('Reset Password') }}
            </x-buttons.primary-button>
        </div>
    </form>
    <x-customer.guest-layout>
