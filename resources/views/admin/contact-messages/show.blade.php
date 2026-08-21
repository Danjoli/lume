<x-admin.app-layout title="Atendimentos">

    <div class="space-y-8 mx-auto max-w-5xl">

        @include('admin.contact-messages._partials.show.header')

        <x-alerts.flash />

        <div
            class="
                mt-8 grid gap-6
                lg:grid-cols-[minmax(0,1fr)_320px]
            "
        >

            @include('admin.contact-messages._partials.show.message')

            @include('admin.contact-messages._partials.show.sidebar')

        </div>

    </div>

</x-admin.app-layout>
