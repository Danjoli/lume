<x-forms.section
    title="Estoque"
    description="Defina quando um livro deve ser considerado com estoque baixo."
>

    <div class="max-w-sm">

        <x-forms.label for="low_stock_threshold">
            Limite de estoque baixo
        </x-forms.label>

        <x-forms.input
            id="low_stock_threshold"
            name="low_stock_threshold"
            type="number"
            min="0"
            :value="old(
                'low_stock_threshold',
                $settings->low_stock_threshold
            )"
        />

        <x-forms.error field="low_stock_threshold" />

    </div>

</x-forms.section>
