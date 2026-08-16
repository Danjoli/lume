<x-forms.section
    title="Pagamento"
    description="Gateways de pagamento."
>

    <div class="space-y-6">

        <x-forms.switch
            id="pix_enabled"
            name="pix_enabled"
            :checked="$settings->pix_enabled"
        >

            PIX

        </x-forms.switch>

        <x-forms.switch
            id="credit_card_enabled"
            name="credit_card_enabled"
            :checked="$settings->credit_card_enabled"
        >

            Cartão

        </x-forms.switch>

        <x-forms.switch
            id="boleto_enabled"
            name="boleto_enabled"
            :checked="$settings->boleto_enabled"
        >

            Boleto

        </x-forms.switch>

    </div>

</x-forms.section>
