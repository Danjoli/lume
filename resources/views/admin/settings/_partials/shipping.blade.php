<x-forms.section
    title="Frete"
    description="Configurações de entrega."
>

    <div class="grid gap-6 md:grid-cols-2">

        <div>

            <x-forms.label
                for="free_shipping"
            >

                Frete Grátis acima de

            </x-forms.label>

            <x-forms.input
                id="free_shipping"
                name="free_shipping"
                type="number"
                step="0.01"
                :value="old('free_shipping', $settings->free_shipping)"
            />

        </div>

        <div>

            <x-forms.label
                for="default_carrier"
            >

                Transportadora

            </x-forms.label>

            <x-forms.input
                id="default_carrier"
                name="default_carrier"
                :value="old('default_carrier', $settings->default_carrier)"
            />

        </div>

    </div>

</x-forms.section>
