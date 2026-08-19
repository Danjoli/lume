<x-forms.section
    title="Frete"
    description="Regras gerais de envio."
>

    <div class="grid gap-6 md:grid-cols-2">

        <div>

            <x-forms.label for="origin_cep">
                CEP de origem
            </x-forms.label>

            <x-forms.input
                id="origin_cep"
                name="origin_cep"
                :value="old('origin_cep', $settings->origin_cep)"
            />

            <x-forms.error field="origin_cep" />

        </div>

        <div>

            <x-forms.label for="free_shipping_threshold">
                Frete grátis acima de
            </x-forms.label>

            <x-forms.input
                id="free_shipping_threshold"
                name="free_shipping_threshold"
                type="number"
                step="0.01"
                min="0"
                :value="old(
                    'free_shipping_threshold',
                    $settings->free_shipping_threshold
                )"
            />

            <x-forms.error field="free_shipping_threshold" />

        </div>

    </div>

</x-forms.section>
