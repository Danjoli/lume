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

                    Transportadora

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Rastreamento

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Status

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Data

                </x-admin.tables.th>

                <x-admin.tables.th class="text-right">

                    Ações

                </x-admin.tables.th>

            </x-admin.tables.tr>

        </x-admin.tables.thead>

        <x-admin.tables.tbody>

            @forelse($shipments as $shipment)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        #{{ $shipment->order->number }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $shipment->order->user->name }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $shipment->carrier }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $shipment->tracking_code ?: '-' }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-badges.shipment-status-badge :status="$shipment->status" />

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $shipment->created_at->format('d/m/Y') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-admin.tables.actions>

                            <x-buttons.icon-button :href="route('admin.shipments.show', $shipment)">

                                <x-admin.icons.icon name="eye" color="yellow" />

                            </x-buttons.icon-button>

                        </x-admin.tables.actions>

                    </x-admin.tables.td>

                </x-admin.tables.tr>

            @empty

                <x-admin.tables.empty message="Nenhum envio encontrado." />
            @endforelse

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
