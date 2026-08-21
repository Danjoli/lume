<x-admin.app-layout title="Newsletter">

    <div class="space-y-8">

        {{-- Cabeçalho --}}
        <div
            class="
                flex flex-col gap-4
                lg:flex-row
                lg:items-end
                lg:justify-between
            "
        >

            <div>

                <p
                    class="
                        text-xs font-bold uppercase
                        tracking-[0.18em]
                        text-[#C96F82]
                    "
                >
                    Marketing
                </p>

                <h1
                    class="
                        mt-2
                        font-['Cormorant_Garamond']
                        text-4xl font-semibold
                        text-[#2A211F]
                    "
                >
                    Newsletter
                </h1>

                <p class="mt-2 text-sm text-[#746B68]">
                    Gerencie os inscritos e acompanhe as campanhas enviadas pela Lume.
                </p>

            </div>

            <a
                href="{{ route('admin.newsletter.create') }}"
                class="
                    inline-flex h-11
                    items-center justify-center
                    gap-2 rounded-lg
                    bg-[#B85D70]
                    px-5 text-sm
                    font-semibold text-white
                    transition
                    hover:bg-[#9F4C5E]
                "
            >
                <x-heroicon-o-plus class="h-4 w-4" />

                Nova campanha
            </a>

        </div>

        <x-alerts.flash />

        @include('admin.newsletter._partials.overview.stats')

        @include('admin.newsletter._partials.overview.subscribers')

        @include('admin.newsletter._partials.overview.campaigns')

</x-admin.app-layout>
