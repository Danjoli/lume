<x-admin.app-layout title="Notificações">

    <div class="space-y-6">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-2xl font-bold text-slate-900">
                    Notificações
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Acompanhe eventos importantes da loja.
                </p>

            </div>

            @if(
                auth('admin')
                    ->user()
                    ->unreadNotifications()
                    ->exists()
            )

                <form
                    method="POST"
                    action="{{ route('admin.notifications.read-all') }}"
                >

                    @csrf
                    @method('PATCH')

                    <x-buttons.secondary-button type="submit">
                        Marcar todas como lidas
                    </x-buttons.secondary-button>

                </form>

            @endif

        </div>

        <x-alerts.flash />

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            @forelse($notifications as $notification)

                <div
                    class="
                        flex items-start justify-between
                        gap-6
                        border-b border-slate-100
                        p-6
                        last:border-b-0

                        {{ $notification->read_at === null
                            ? 'bg-indigo-50/40'
                            : 'bg-white'
                        }}
                    "
                >

                    <div class="flex min-w-0 flex-1 gap-4">

                        {{-- Indicador --}}
                        <div class="pt-2">

                            @if($notification->read_at === null)

                                <span
                                    class="
                                        block h-2.5 w-2.5
                                        rounded-full
                                        bg-indigo-600
                                    "
                                ></span>

                            @else

                                <span
                                    class="
                                        block h-2.5 w-2.5
                                        rounded-full
                                        bg-slate-300
                                    "
                                ></span>

                            @endif

                        </div>

                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-2">

                                <h2 class="font-semibold text-slate-900">
                                    {{ $notification->data['title'] ?? 'Notificação' }}
                                </h2>

                                @if($notification->read_at === null)

                                    <span
                                        class="
                                            rounded-full
                                            bg-indigo-100
                                            px-2 py-0.5
                                            text-xs font-semibold
                                            text-indigo-700
                                        "
                                    >
                                        Nova
                                    </span>

                                @endif

                            </div>

                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                {{ $notification->data['message'] ?? '' }}
                            </p>

                            <p class="mt-2 text-xs text-slate-400">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>

                        </div>

                    </div>

                    <div class="flex shrink-0 items-center gap-2">

                        {{-- Abrir --}}
                        <x-buttons.icon-button
                            :href="route(
                                'admin.notifications.show',
                                $notification
                            )"
                            title="Abrir"
                        >
                            <x-admin.icons.icon
                                name="eye"
                                color="blue"
                            />
                        </x-buttons.icon-button>

                        {{-- Marcar como lida --}}
                        @if($notification->read_at === null)

                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.notifications.read',
                                    $notification
                                ) }}"
                            >

                                @csrf
                                @method('PATCH')

                                <x-buttons.icon-button
                                    type="submit"
                                    title="Marcar como lida"
                                >
                                    <x-heroicon-o-check
                                        class="h-5 w-5 text-green-600"
                                    />
                                </x-buttons.icon-button>

                            </form>

                        @endif

                        {{-- Excluir --}}
                        <form
                            method="POST"
                            action="{{ route(
                                'admin.notifications.destroy',
                                $notification
                            ) }}"
                            onsubmit="return confirm(
                                'Deseja excluir esta notificação?'
                            )"
                        >

                            @csrf
                            @method('DELETE')

                            <x-buttons.icon-button
                                type="submit"
                                title="Excluir"
                            >
                                <x-admin.icons.icon
                                    name="trash"
                                    color="red"
                                />
                            </x-buttons.icon-button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="px-6 py-16 text-center">

                    <x-heroicon-o-bell
                        class="mx-auto h-12 w-12 text-slate-300"
                    />

                    <h2 class="mt-4 font-semibold text-slate-900">
                        Nenhuma notificação
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Quando algo importante acontecer na loja,
                        aparecerá aqui.
                    </p>

                </div>

            @endforelse

        </div>

        @if($notifications->hasPages())

            <div>
                {{ $notifications->links() }}
            </div>

        @endif

    </div>

</x-admin.app-layout>
