<x-admin.cards.card class="overflow-hidden p-0">

    <x-admin.tables.table>

        <x-admin.tables.thead>

            <x-admin.tables.tr>

                <x-admin.tables.th>

                    Usuário

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Status

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Verificado

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

            @forelse($users as $user)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        <div>

                            <p class="font-medium text-slate-900">

                                {{ $user->name }}

                            </p>

                            <p class="text-sm text-slate-500">

                                {{ $user->email }}

                            </p>

                        </div>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-badges.status-badge :status="$user->status" />

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        @if ($user->email_verified_at)
                            <x-badges.badge variant="green">

                                Verificado

                            </x-badges.badge>
                        @else
                            <x-badges.badge variant="red">

                                Pendente

                            </x-badges.badge>
                        @endif

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $user->created_at->format('d/m/Y') }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-admin.tables.actions>

                            <x-buttons.icon-button :href="route('admin.users.show', $user)" title="Visualizar">

                                <x-admin.icons.icon name="eye" color="yellow" />

                            </x-buttons.icon-button>

                            <x-buttons.icon-button :href="route('admin.users.edit', $user)" title="Editar">

                                <x-admin.icons.icon name="edit" color="blue" />

                            </x-buttons.icon-button>

                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                onsubmit="return confirm('Deseja excluir este usuário?')">

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

                <x-admin.tables.empty message="Nenhum usuário encontrado." />
            @endforelse

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
