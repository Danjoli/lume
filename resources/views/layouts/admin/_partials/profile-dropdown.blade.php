<div
    x-data="{ open: false }"
    class="relative"
>

    {{-- Botão --}}
    <button
        @click="open = !open"
        class="flex items-center gap-3 rounded-lg p-2 transition hover:bg-gray-100"
    >

        {{-- Avatar --}}
        <div
            class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white"
        >

            {{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}

        </div>

        {{-- Nome --}}
        <div class="hidden text-left md:block">

            <p class="text-sm font-semibold text-gray-900">

                {{ auth('admin')->user()->name }}

            </p>

            <p class="text-xs text-gray-500">

                {{ auth('admin')->user()->role->label() }}

            </p>

        </div>

        {{-- Seta --}}
        <svg
            class="h-4 w-4 text-gray-500"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m19 9-7 7-7-7"
            />
        </svg>

    </button>

    {{-- Dropdown --}}
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="absolute right-0 mt-2 w-60 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl"
    >

        <div class="border-b border-gray-200 p-4">

            <p class="font-semibold text-gray-900">

                {{ auth('admin')->user()->name }}

            </p>

            <p class="text-sm text-gray-500">

                {{ auth('admin')->user()->email }}

            </p>

        </div>

        <a
            href="{{ route('admin.profile.edit') }}"
            class="block px-4 py-3 text-sm text-gray-700 transition hover:bg-gray-100"
        >
            Meu Perfil
        </a>

        <a
            href="{{ route('admin.settings.index') }}"
            class="block px-4 py-3 text-sm text-gray-700 transition hover:bg-gray-100"
        >
            Configurações
        </a>

        <div class="border-t border-gray-200">

            <form
                method="POST"
                action="{{ route('admin.logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="block w-full px-4 py-3 text-left text-sm font-medium text-red-600 transition hover:bg-red-50"
                >

                    Sair

                </button>

            </form>

        </div>

    </div>

</div>
