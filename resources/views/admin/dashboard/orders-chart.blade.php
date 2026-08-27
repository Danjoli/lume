<x-admin.cards.card title="Pedidos dos últimos 7 dias">

    <x-admin.charts.line-chart
        id="sales-chart"
        :height="260"
        chart="orders-line"
        :labels="collect($ordersChart)->pluck('label')->values()"
        :values="collect($ordersChart)->pluck('value')->values()"
    />

</x-admin.cards.card>
