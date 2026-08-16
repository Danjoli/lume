<x-admin.cards.card title="Pedidos recentes">

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead>

                <tr class="bg-gray-300">

                    <th class="rounded-l-md py-2 px-2 text-left text-sm font-semibold text-slate-700">
                        #
                    </th>

                    <th class="text-left text-sm py-2 font-semibold text-slate-700">
                        Cliente
                    </th>

                    <th class="text-left text-sm py-2 font-semibold text-slate-700">
                        Total
                    </th>

                    <th class="text-left text-sm py-2 font-semibold text-slate-700">
                        Status
                    </th>

                    <th class="rounded-r-md text-left py-2 text-sm font-semibold text-slate-700">
                        Data
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($recentOrders as $order)
                    <tr class="transition hover:bg-slate-50">

                        <td class="px-2 py-4 text-sm font-medium text-slate-900">
                            #{{ $order->id }}
                        </td>

                        <td class="py-4 text-sm text-slate-700">
                            {{ $order->user?->name ?? 'Cliente não encontrado' }}
                        </td>

                        <td class="py-4 text-sm font-medium text-slate-900">
                            R$ {{ number_format($order->total, 2, ',', '.') }}
                        </td>

                        <td class="py-4">

                            <x-badges.badge :variant="match ($order->status) {
                                'pending' => 'yellow',
                                'paid' => 'green',
                                'shipped' => 'blue',
                                'cancelled' => 'red',
                                default => 'gray',
                            }">
                                {{ ucfirst($order->status->value) }}
                            </x-badges.badge>

                        </td>

                        <td class="py-4 text-sm text-slate-500">
                            {{ $order->created_at->format('d/m/Y') }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="py-8 text-center text-sm text-slate-500">
                            Nenhum pedido encontrado.
                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-auto pt-6">

        <a href="#"
            class="inline-flex items-center gap-2 text-sm font-medium text-indigo-600 transition hover:text-indigo-700">

            Ver todos os pedidos

            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>

        </a>

    </div>

</x-admin.cards.card>
