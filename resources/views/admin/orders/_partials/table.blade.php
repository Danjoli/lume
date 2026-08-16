<x-admin.cards.card class="overflow-hidden p-0">

    <x-admin.tables.table>

        <x-admin.tables.thead>

            <x-admin.tables.tr>

                <x-admin.tables.th>

                    Pedido

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Cliente

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Total

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Pagamento

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Envio

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Criado em

                </x-admin.tables.th>

                <x-admin.tables.th class="text-right">

                    Ações

                </x-admin.tables.th>

            </x-admin.tables.tr>

        </x-admin.tables.thead>

        <x-admin.tables.tbody>

            @forelse($orders as $order)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        <div>

                            <p class="font-semibold">

                                #{{ $order->number }}

                            </p>

                            <p class="text-xs text-slate-500">

                                {{ $order->status->label() }}

                            </p>

                        </div>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <div>

                            <p class="font-medium">

                                {{ $order->user->name }}

                            </p>

                            <p class="text-xs text-slate-500">

                                {{ $order->user->email }}

                            </p>

                        </div>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        R$
                        {{ number_format($order->total, 2, ',', '.') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-badges.status-badge :status="$order->payment_status" />

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-badges.status-badge :status="$order->shipment_status" />

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $order->created_at->format('d/m/Y') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-admin.tables.actions>

                            <x-buttons.icon-button :href="route('admin.orders.show', $order)" title="Visualizar">

                                <x-admin.icons.icon name="eye" color="yellow" />

                            </x-buttons.icon-button>

                        </x-admin.tables.actions>

                    </x-admin.tables.td>

                </x-admin.tables.tr>

            @empty

                <x-admin.tables.empty message="Nenhum pedido encontrado." />
            @endforelse

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
