<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Histórico

    </h2>

    <ul class="space-y-4">

        @foreach ($shipment->histories as $history)
            <li>

                <p class="font-medium">

                    {{ $history->title }}

                </p>

                <p class="text-sm text-slate-500">

                    {{ $history->created_at->format('d/m/Y H:i') }}

                </p>

            </li>
        @endforeach

    </ul>

</x-admin.cards.card>
