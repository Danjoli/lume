<x-admin.app-layout title="Cupons">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Cupons" description="Gerencie os cupons de desconto da loja.">

            <x-buttons.primary-button :href="route('admin.coupons.create')">
                Novo Cupom
            </x-buttons.primary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        @include('admin.coupons._partials.filters')

        @include('admin.coupons._partials.table')

        <x-admin.tables.pagination :paginator="$coupons" />

    </div>

</x-admin.app-layout>
