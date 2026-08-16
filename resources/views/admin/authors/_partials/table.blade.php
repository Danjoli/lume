<x-admin.cards.card class="overflow-hidden p-0">

    <x-admin.tables.table>

        <x-admin.tables.thead>

            <x-admin.tables.tr>

                <x-admin.tables.th>

                    Nome

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Livros

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

            @forelse($authors as $author)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        <div>

                            <p class="font-medium text-slate-900">

                                {{ $author->name }}

                            </p>

                            <p class="text-xs text-slate-500">

                                {{ $author->slug }}

                            </p>

                        </div>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-badges.badge>

                            {{ $author->books_count }}

                        </x-badges.badge>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $author->created_at->format('d/m/Y') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-admin.tables.actions>

                            <x-buttons.icon-button :href="route('admin.authors.show', $author)" title="Visualizar">

                                <x-admin.icons.icon name="eye" color="yellow" />

                            </x-buttons.icon-button>

                            <x-buttons.icon-button :href="route('admin.authors.edit', $author)" title="Editar">

                                <x-admin.icons.icon name="edit" color="blue" color="blue" />

                            </x-buttons.icon-button>

                            <form method="POST" action="{{ route('admin.authors.destroy', $author) }}"
                                onsubmit="return confirm('Deseja realmente excluir este autor?')">

                                @csrf
                                @method('DELETE')

                                <x-buttons.icon-button type="submit" title="Excluir">

                                    <x-admin.icons.icon name="eye" color="red" />

                                </x-buttons.icon-button>

                            </form>

                        </x-admin.tables.actions>

                    </x-admin.tables.td>

                </x-admin.tables.tr>

            @empty

                <x-admin.tables.empty message="Nenhum autor encontrado." />
            @endforelse

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
