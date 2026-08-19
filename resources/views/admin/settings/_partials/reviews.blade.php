<x-forms.section
    title="Avaliações"
    description="Defina as regras para avaliações de livros."
>

    <div class="space-y-4">

        <label class="flex items-center gap-3">

            <input
                type="checkbox"
                name="reviews_require_purchase"
                value="1"
                @checked(
                    old(
                        'reviews_require_purchase',
                        $settings->reviews_require_purchase
                    )
                )
            >

            <span class="text-sm text-slate-700">
                Exigir compra para permitir avaliação
            </span>

        </label>

        <label class="flex items-center gap-3">

            <input
                type="checkbox"
                name="reviews_auto_approve"
                value="1"
                @checked(
                    old(
                        'reviews_auto_approve',
                        $settings->reviews_auto_approve
                    )
                )
            >

            <span class="text-sm text-slate-700">
                Aprovar avaliações automaticamente
            </span>

        </label>

    </div>

</x-forms.section>
