<x-admin.app-layout :title="'Envio #' . $shipment->id">

    <div class="space-y-8">

        <x-admin.headers.page-header :title="'Envio #' . $shipment->id" description="Visualize todas as informações do envio.">

            <x-buttons.secondary-button :href="route('admin.shipments.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.shipments._partials.show.actions')

        <div class="grid gap-6 lg:grid-cols-3">

            <div class="space-y-6 lg:col-span-2">

                @include('admin.shipments._partials.show.summary')

                @include('admin.shipments._partials.show.tracking')

                @include('admin.shipments._partials.show.timeline')

            </div>

            <div class="space-y-6">

                @include('admin.shipments._partials.show.recipient')

                @include('admin.shipments._partials.show.address')

            </div>

        </div>

    </div>

</x-admin.app-layout>
