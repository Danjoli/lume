<x-admin.cards.card>

    <div class="flex flex-wrap gap-3">

        @if ($review->status !== 'approved')
            <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">

                @csrf

                <x-buttons.primary-button type="submit">

                    Aprovar

                </x-buttons.primary-button>

            </form>
        @endif

        @if ($review->status !== 'rejected')
            <form method="POST" action="{{ route('admin.reviews.reject', $review) }}">

                @csrf

                <x-buttons.secondary-button type="submit">

                    Rejeitar

                </x-buttons.secondary-button>

            </form>
        @endif

        <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}"
            onsubmit="return confirm('Deseja excluir esta avaliação?')">

            @csrf
            @method('DELETE')

            <x-buttons.danger-button type="submit">

                Excluir

            </x-buttons.danger-button>

        </form>

    </div>

</x-admin.cards.card>
