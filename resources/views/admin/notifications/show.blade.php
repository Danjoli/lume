<x-admin.app-layout :title="$notification->title">

    <div class="space-y-8">

        <x-admin.headers.page-header :title="$notification->title" description="Detalhes da notificação.">

            <x-buttons.secondary-button :href="route('admin.notifications.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <div class="grid gap-6 lg:grid-cols-3">

            <div class="space-y-6 lg:col-span-2">

                @include('admin.notifications._partials.show.notification')

            </div>

            <div>

                @include('admin.notifications._partials.show.recipient')

            </div>

        </div>

    </div>

</x-admin.app-layout>
