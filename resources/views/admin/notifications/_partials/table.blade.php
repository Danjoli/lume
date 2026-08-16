<x-admin.cards.card class="overflow-hidden p-0">

    <x-admin.tables.table>

        <x-admin.tables.thead>

            <x-admin.tables.tr>

                <x-admin.tables.th>

                    Título

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Usuário

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

            @foreach ($notifications as $notification)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        {{ $notification->title }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $notification->user->name }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        @if ($notification->read_at)
                            <x-badges.badge variant="green">

                                Lida

                            </x-badges.badge>
                        @else
                            <x-badges.badge variant="yellow">

                                Pendente

                            </x-badges.badge>
                        @endif

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $notification->created_at->format('d/m/Y') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-buttons.icon-button :href="route('admin.notifications.show', $notification)">

                            <x-admin.icons.icon name="eye" color="yellow" />

                        </x-buttons.icon-button>

                    </x-admin.tables.td>

                </x-admin.tables.tr>
            @endforeach

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
