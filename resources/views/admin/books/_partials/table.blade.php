<x-admin.cards.card class="overflow-hidden p-0">

    <x-admin.tables.table>

        <x-admin.tables.thead>

            <x-admin.tables.tr>

                <x-admin.tables.th>

                    Capa

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Livro

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Editora

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Preço

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Estoque

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Status

                </x-admin.tables.th>

                <x-admin.tables.th class="text-right">

                    Ações

                </x-admin.tables.th>

            </x-admin.tables.tr>

        </x-admin.tables.thead>

        <x-admin.tables.tbody>

            @forelse($books as $book)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        @if ($book->cover)
                            <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}"
                                class="h-16 w-12 rounded object-cover">
                        @else
                            <div
                                class="flex h-16 w-12 items-center justify-center rounded bg-slate-100 text-xs text-slate-400">

                                Sem capa

                            </div>
                        @endif

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <div>

                            <p class="font-medium text-slate-900">

                                {{ $book->title }}

                            </p>

                            <p class="text-xs text-slate-500">

                                ISBN: {{ $book->isbn }}

                            </p>

                        </div>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $book->publisher?->name }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        R$ {{ number_format($book->price, 2, ',', '.') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        @if ($book->stock > 0)
                            <x-badges.badge variant="green">

                                {{ $book->stock }}

                            </x-badges.badge>
                        @else
                            <x-badges.badge variant="red">

                                Sem estoque

                            </x-badges.badge>
                        @endif

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-badges.status-badge :status="$book->status" />

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-admin.tables.actions>

                            <x-buttons.icon-button :href="route('admin.books.show', $book)" title="Visualizar">

                                <x-admin.icons.icon name="eye" color="yellow" />

                            </x-buttons.icon-button>

                            <x-buttons.icon-button :href="route('admin.books.edit', $book)" title="Editar">

                                <x-admin.icons.icon name="edit" color="blue" />

                            </x-buttons.icon-button>

                            <form method="POST" action="{{ route('admin.books.destroy', $book) }}"
                                onsubmit="return confirm('Deseja realmente excluir este livro?')">

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

                <x-admin.tables.empty message="Nenhum livro encontrado." />
            @endforelse

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
