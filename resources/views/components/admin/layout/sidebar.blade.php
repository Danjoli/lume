<aside
    class="flex h-screen w-72 flex-col
    border-r border-slate-800
    text-white"
>

    {{-- Logo --}}
    <x-admin.layout.sidebar-logo />

    {{-- Menu --}}
    <div class="flex-1 overflow-y-auto px-4 py-6 bg-slate-800">

        <x-admin.layout.sidebar-menu />

    </div>

    {{-- Rodapé --}}
    <div class="border-t border-gray-800 p-4 bg-slate-900">

        <form
            method="POST"
            action="{{ route('admin.logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-white transition hover:bg-red-900"
            >

                {{-- Ícone Logout --}}
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H9m4 8H7a2 2 0 01-2-2V6a2 2 0 012-2h6"
                    />
                </svg>

                <span>Sair</span>

            </button>

        </form>

    </div>

</aside>
