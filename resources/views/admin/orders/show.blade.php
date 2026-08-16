<x-admin.app-layout :title="'Pedido #' . $order->number">

    <div class="space-y-8">

        <x-admin.headers.page-header :title="'Pedido #' . $order->number" description="Visualize todas as informações do pedido.">

            <x-buttons.secondary-button :href="route('admin.orders.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.orders._partials.show.actions')

        <div class="grid gap-6 lg:grid-cols-3">

            <div class="space-y-6 lg:col-span-2">

                @include('admin.orders._partials.show.summary')

                @include('admin.orders._partials.show.items')

                @include('admin.orders._partials.show.timeline')

            </div>

            <div class="space-y-6">

                @include('admin.orders._partials.show.customer')

                @include('admin.orders._partials.show.address')

                @include('admin.orders._partials.show.payment')

                @include('admin.orders._partials.show.shipment')

            </div>

        </div>

    </div>

</x-admin.app-layout>
