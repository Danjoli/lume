<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Avaliação

    </h2>

    <dl class="space-y-6">

        <div>

            <dt class="text-sm font-medium text-slate-500">

                Nota

            </dt>

            <dd class="mt-1 text-lg">

                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->rating)
                        ⭐
                    @else
                        ☆
                    @endif
                @endfor

            </dd>

        </div>

        @if ($review->title)
            <div>

                <dt class="text-sm font-medium text-slate-500">

                    Título

                </dt>

                <dd class="mt-1">

                    {{ $review->title }}

                </dd>

            </div>
        @endif

        <div>

            <dt class="text-sm font-medium text-slate-500">

                Comentário

            </dt>

            <dd class="mt-1 whitespace-pre-line">

                {{ $review->comment }}

            </dd>

        </div>

        <div>

            <dt class="text-sm font-medium text-slate-500">

                Status

            </dt>

            <dd class="mt-1">

                <x-badges.status-badge :status="$review->status" />

            </dd>

        </div>

        <div>

            <dt class="text-sm font-medium text-slate-500">

                Criada em

            </dt>

            <dd class="mt-1">

                {{ $review->created_at->format('d/m/Y H:i') }}

            </dd>

        </div>

    </dl>

</x-admin.cards.card>
