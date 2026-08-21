<x-admin.app-layout :title="'Envio #' . $shipment->id">

    <div class="space-y-5">

        <x-admin.headers.page-header :title="'Envio #' . $shipment->id" :description="'Pedido #' . $shipment->order->number . ' • ' . $shipment->order->recipient_name">

            <x-buttons.secondary-button :href="route('admin.shipments.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.shipments.show.actions')

        <div class="grid gap-4 xl:grid-cols-3">

            <div class="space-y-4 xl:col-span-2">

                @include('admin.shipments.show.summary')

                @include('admin.shipments.show.tracking')

                @include('admin.shipments.show.timeline')

            </div>

            <div class="space-y-4">

                @include('admin.shipments.show.recipient')

                @include('admin.shipments.show.address')

            </div>

        </div>

    </div>

</x-admin.app-layout>
