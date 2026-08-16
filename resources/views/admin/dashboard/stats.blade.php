<div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-4">

    <x-admin.cards.stat-card title="Total de Livros" :value="$stats['books']" :change="$stats['booksThisMonth'] . ' este mês'" icon="book" color="indigo" />

    <x-admin.cards.stat-card title="Total de Pedidos" :value="$stats['orders']" :change="$stats['ordersThisMonth'] . ' este mês'" icon="orders" color="green" />

    <x-admin.cards.stat-card title="Total de Clientes" :value="$stats['users']" :change="$stats['usersThisMonth'] . ' este mês'" icon="users" color="yellow" />

    <x-admin.cards.stat-card title="Faturamento" :value="'R$ ' . number_format($stats['revenue'], 2, ',', '.')" :change="$stats['revenueChange']['value'] . '% este mês'" :changeType="$stats['revenueChange']['type']" icon="money"
        color="blue" />

</div>
