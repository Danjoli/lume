<x-admin.cards.card class="overflow-hidden p-0">

    <x-admin.tables.table>

        <x-admin.tables.thead>

            <x-admin.tables.tr>

                <x-admin.tables.th>
                    Administrador
                </x-admin.tables.th>

                <x-admin.tables.th>
                    E-mail
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

            @forelse($admins as $admin)

                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100"
                            >
                                <span class="text-sm font-semibold text-slate-600">
                                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                                </span>
                            </div>

                            <div>

                                <p class="font-medium text-slate-900">
                                    {{ $admin->name }}
                                </p>

                                <p class="text-xs text-slate-500">
                                    ID #{{ $admin->id }}
                                </p>

                            </div>

                        </div>

                    </x-admin.tables.td>

                    <x-admin.tables.td>
                        {{ $admin->email }}
                    </x-admin.tables.td>

                    <x-admin.tables.td>
                        {{ $admin->created_at?->format('d/m/Y H:i') }}
                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-admin.tables.actions>

                            <x-buttons.icon-button
                                :href="route('admin.admins.show', $admin)"
                                title="Visualizar"
                            >
                                <x-admin.icons.icon
                                    name="eye"
                                    color="blue"
                                />
                            </x-buttons.icon-button>

                            <x-buttons.icon-button
                                :href="route('admin.admins.edit', $admin)"
                                title="Editar"
                            >
                                <x-admin.icons.icon
                                    name="edit"
                                    color="yellow"
                                />
                            </x-buttons.icon-button>

                            <form
                                method="POST"
                                action="{{ route('admin.admins.destroy', $admin) }}"
                                onsubmit="return confirm('Deseja realmente excluir este administrador?')"
                            >

                                @csrf
                                @method('DELETE')

                                <x-buttons.icon-button
                                    type="submit"
                                    title="Excluir"
                                >
                                    <x-admin.icons.icon
                                        name="trash"
                                        color="red"
                                    />
                                </x-buttons.icon-button>

                            </form>

                        </x-admin.tables.actions>

                    </x-admin.tables.td>

                </x-admin.tables.tr>

            @empty

                <x-admin.tables.empty
                    colspan="4"
                    message="Nenhum administrador encontrado."
                />

            @endforelse

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
