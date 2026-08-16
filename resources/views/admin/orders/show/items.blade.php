<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Itens do Pedido

    </h2>

    <x-admin.tables.table>

        <x-admin.tables.thead>

            <x-admin.tables.tr>

                <x-admin.tables.th>

                    Livro

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Quantidade

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Valor

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Subtotal

                </x-admin.tables.th>

            </x-admin.tables.tr>

        </x-admin.tables.thead>

        <x-admin.tables.tbody>

            @foreach ($order->items as $item)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        {{ $item->book->title }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $item->quantity }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        R$
                        {{ number_format($item->price, 2, ',', '.') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        R$
                        {{ number_format($item->subtotal, 2, ',', '.') }}

                    </x-admin.tables.td>

                </x-admin.tables.tr>
            @endforeach

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
