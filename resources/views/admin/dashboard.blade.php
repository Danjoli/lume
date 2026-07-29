<x-admin.app-layout>
    <div class="p-8">

        <h1 class="text-3xl font-bold">
            Dashboard
        </h1>

        <p class="mt-2 text-gray-600">
            Bem-vindo ao painel administrativo do Lume.
        </p>

    </div>

    <!-- Authentication -->
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf

        <x-dropdown-link :href="route('admin.logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
</x-admin.app-layout>
