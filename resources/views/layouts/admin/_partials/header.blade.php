<header class="flex h-16 items-center justify-between border-b border-slate-200 bg-white px-8">

    {{-- Menu --}}
    <button
        type="button"
        @click="sidebarOpen = !sidebarOpen"
        class="rounded-lg p-2 text-slate-600 transition hover:bg-slate-100"
    >
        <x-heroicon-o-bars-3 class="h-7 w-7" />
    </button>

    {{-- Direita --}}
    <div class="flex items-center gap-6">

        {{-- Notificações --}}
        <div
            x-data="{ open: false }"
            class="relative"
        >

            @php
                $admin = auth('admin')->user();

                $unreadCount = $admin
                    ->unreadNotifications()
                    ->count();
            @endphp

            <button
                type="button"
                @click="open = !open"
                class="relative rounded-lg p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900"
            >

                <x-heroicon-o-bell class="h-6 w-6" />

                @if($unreadCount > 0)

                    <span
                        class="
                            absolute -right-1 -top-1
                            flex h-5 min-w-5
                            items-center justify-center
                            rounded-full
                            bg-indigo-600
                            px-1
                            text-[10px]
                            font-bold
                            text-white
                        "
                    >
                        {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                    </span>

                @endif

            </button>

            @include('layouts.admin._partials.notifications-dropdown')

        </div>

        @include('layouts.admin._partials.profile-dropdown')

    </div>

</header>
