<x-admin.cards.card class="overflow-hidden p-0">

    <x-admin.tables.table>

        <x-admin.tables.thead>

            <x-admin.tables.tr>

                <x-admin.tables.th>Nome</x-admin.tables.th>

                <x-admin.tables.th>Livros</x-admin.tables.th>

                <x-admin.tables.th>Criado em</x-admin.tables.th>

                <x-admin.tables.th class="text-right">

                    Ações

                </x-admin.tables.th>

            </x-admin.tables.tr>

        </x-admin.tables.thead>

        <x-admin.tables.tbody>

            @forelse($publishers as $publisher)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        <div>

                            <p class="font-medium">

                                {{ $publisher->name }}

                            </p>

                            <p class="text-xs text-slate-500">

                                {{ $publisher->slug }}

                            </p>

                        </div>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-badges.badge>

                            {{ $publisher->books_count }}

                        </x-badges.badge>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $publisher->created_at->format('d/m/Y') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-admin.tables.actions>

                            <x-buttons.icon-button :href="route('admin.publishers.show', $publisher)">
                                <x-admin.icons.icon name="eye" color="yellow" />
                            </x-buttons.icon-button>

                            <x-buttons.icon-button :href="route('admin.publishers.edit', $publisher)">
                                <x-admin.icons.icon name="edit" color="blue" />
                            </x-buttons.icon-button>

                        </x-admin.tables.actions>

                    </x-admin.tables.td>

                </x-admin.tables.tr>

            @empty

                <x-admin.tables.empty message="Nenhuma editora encontrada." />
            @endforelse

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
