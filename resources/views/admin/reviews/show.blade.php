<x-admin.app-layout :title="'Avaliação #' . $review->id">

    <div class="space-y-8">

        <x-admin.headers.page-header :title="'Avaliação #' . $review->id" description="Detalhes da avaliação.">

            <x-buttons.secondary-button :href="route('admin.reviews.index')">

                Voltar

            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.reviews._partials.show.actions')

        <div class="grid gap-6 lg:grid-cols-3">

            <div class="space-y-6 lg:col-span-2">

                @include('admin.reviews._partials.show.review')

            </div>

            <div class="space-y-6">

                @include('admin.reviews._partials.show.customer')

                @include('admin.reviews._partials.show.book')

            </div>

        </div>

    </div>

</x-admin.app-layout>
