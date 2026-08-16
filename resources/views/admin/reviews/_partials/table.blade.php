<x-admin.cards.card class="overflow-hidden p-0">

    <x-admin.tables.table>

        <x-admin.tables.thead>

            <x-admin.tables.tr>

                <x-admin.tables.th>

                    Livro

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Cliente

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Nota

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

            @forelse($reviews as $review)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        {{ $review->book->title }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $review->user->name }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        ⭐ {{ $review->rating }}/5

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-badges.status-badge :status="$review->status" />

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $review->created_at->format('d/m/Y') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-admin.tables.actions>

                            <x-buttons.icon-button :href="route('admin.reviews.show', $review)">

                                <x-admin.icons.icon name="eye" color="yellow" />

                            </x-buttons.icon-button>

                        </x-admin.tables.actions>

                    </x-admin.tables.td>

                </x-admin.tables.tr>

            @empty

                <x-admin.tables.empty message="Nenhuma avaliação encontrada." />
            @endforelse

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
