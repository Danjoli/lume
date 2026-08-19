@php
    $notifications = auth('admin')
        ->user()
        ->notifications()
        ->latest()
        ->limit(5)
        ->get();

    $unreadCount = auth('admin')
        ->user()
        ->unreadNotifications()
        ->count();
@endphp

<div
    x-cloak
    x-show="open"
    x-transition
    @click.outside="open = false"
    class="
        absolute right-0 z-50 mt-2
        w-96 overflow-hidden
        rounded-xl
        border border-slate-200
        bg-white
        shadow-xl
    "
>

    {{-- Cabeçalho --}}
    <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">

        <div>

            <h3 class="font-semibold text-slate-900">
                Notificações
            </h3>

            <p class="text-xs text-slate-500">
                {{ $unreadCount }}
                {{ $unreadCount === 1 ? 'não lida' : 'não lidas' }}
            </p>

        </div>

        @if($unreadCount > 0)

            <form
                method="POST"
                action="{{ route('admin.notifications.read-all') }}"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="text-xs font-medium text-indigo-600 hover:text-indigo-800"
                >
                    Marcar todas como lidas
                </button>

            </form>

        @endif

    </div>

    {{-- Lista --}}
    <div class="max-h-96 overflow-y-auto">

        @forelse($notifications as $notification)

            <a
                href="{{ route('admin.notifications.show', $notification) }}"
                class="
                    block
                    border-b border-slate-100
                    px-5 py-4
                    transition
                    hover:bg-slate-50

                    {{ $notification->read_at === null
                        ? 'bg-indigo-50/40'
                        : ''
                    }}
                "
            >

                <div class="flex gap-3">

                    {{-- Indicador --}}
                    @if($notification->read_at === null)

                        <span
                            class="
                                mt-2 h-2 w-2
                                shrink-0
                                rounded-full
                                bg-indigo-600
                            "
                        ></span>

                    @else

                        <span class="mt-2 h-2 w-2 shrink-0"></span>

                    @endif

                    <div class="min-w-0">

                        <p class="text-sm font-semibold text-slate-900">
                            {{ $notification->data['title'] ?? 'Notificação' }}
                        </p>

                        <p class="mt-1 text-sm leading-5 text-slate-600">
                            {{ $notification->data['message'] ?? '' }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            {{ $notification->created_at->diffForHumans() }}
                        </p>

                    </div>

                </div>

            </a>

        @empty

            <div class="px-5 py-10 text-center">

                <x-heroicon-o-bell
                    class="mx-auto h-8 w-8 text-slate-300"
                />

                <p class="mt-3 text-sm text-slate-500">
                    Nenhuma notificação.
                </p>

            </div>

        @endforelse

    </div>

    {{-- Rodapé --}}
    <a
        href="{{ route('admin.notifications.index') }}"
        class="
            block
            border-t border-slate-200
            px-5 py-4
            text-center
            text-sm font-semibold
            text-indigo-600
            transition
            hover:bg-slate-50
        "
    >
        Ver todas as notificações
    </a>

</div>
