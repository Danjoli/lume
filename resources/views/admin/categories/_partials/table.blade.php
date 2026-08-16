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

            @forelse($categories as $category)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        <div>

                            <p class="font-medium">

                                {{ $category->name }}

                            </p>

                            <p class="text-xs text-slate-500">

                                {{ $category->slug }}

                            </p>

                        </div>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-badges.badge>

                            {{ $category->books_count }}

                        </x-badges.badge>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $category->created_at->format('d/m/Y') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-admin.tables.actions>

                            <x-buttons.icon-button :href="route('admin.categories.show', $category)">
                                <x-admin.icons.icon name="eye" color="yellow" />
                            </x-buttons.icon-button>

                            <x-buttons.icon-button :href="route('admin.categories.edit', $category)">
                                <x-admin.icons.icon name="edit" color="blue" />
                            </x-buttons.icon-button>

                        </x-admin.tables.actions>

                    </x-admin.tables.td>

                </x-admin.tables.tr>

            @empty

                <x-admin.tables.empty message="Nenhuma categoria encontrada." />
            @endforelse

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
