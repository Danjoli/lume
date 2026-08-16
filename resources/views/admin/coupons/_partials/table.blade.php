<x-admin.cards.card class="overflow-hidden p-0">

    <x-admin.tables.table>

        <x-admin.tables.thead>

            <x-admin.tables.tr>

                <x-admin.tables.th>

                    Código

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Tipo

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Valor

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Utilizações

                </x-admin.tables.th>

                <x-admin.tables.th>

                    Expira

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

            @forelse($coupons as $coupon)
                <x-admin.tables.tr>

                    <x-admin.tables.td>

                        <span class="font-mono font-semibold">

                            {{ $coupon->code }}

                        </span>

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $coupon->type === 'percentage' ? 'Percentual' : 'Valor Fixo' }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        @if ($coupon->type === 'percentage')
                            {{ $coupon->value }}%
                        @else
                            R$ {{ number_format($coupon->value, 2, ',', '.') }}
                        @endif

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ $coupon->used_count }}

                        /

                        {{ $coupon->usage_limit ?: '∞' }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        {{ optional($coupon->expires_at)->format('d/m/Y') ?: '-' }}

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        @if ($coupon->active)
                            <x-badges.badge variant="green">

                                Ativo

                            </x-badges.badge>
                        @else
                            <x-badges.badge variant="red">

                                Inativo

                            </x-badges.badge>
                        @endif

                    </x-admin.tables.td>

                    <x-admin.tables.td>

                        <x-admin.tables.actions>

                            <x-buttons.icon-button :href="route('admin.coupons.show', $coupon)">

                                <x-admin.icons.icon name="eye" color="yellow" />

                            </x-buttons.icon-button>

                            <x-buttons.icon-button :href="route('admin.coupons.edit', $coupon)">

                                <x-admin.icons.icon name="edit" color="blue" />

                            </x-buttons.icon-button>

                        </x-admin.tables.actions>

                    </x-admin.tables.td>

                </x-admin.tables.tr>

            @empty

                <x-admin.tables.empty message="Nenhum cupom encontrado." />
            @endforelse

        </x-admin.tables.tbody>

    </x-admin.tables.table>

</x-admin.cards.card>
