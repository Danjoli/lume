<x-forms.section
    title="E-mail"
    description="Informações utilizadas no envio de e-mails da loja."
>

    <div class="grid gap-6 md:grid-cols-2">

        <div>

            <x-forms.label for="sender_name">
                Nome do remetente
            </x-forms.label>

            <x-forms.input
                id="sender_name"
                name="sender_name"
                :value="old('sender_name', $settings->sender_name)"
            />

            <x-forms.error field="sender_name" />

        </div>

        <div>

            <x-forms.label for="sender_email">
                E-mail do remetente
            </x-forms.label>

            <x-forms.input
                id="sender_email"
                name="sender_email"
                type="email"
                :value="old('sender_email', $settings->sender_email)"
            />

            <x-forms.error field="sender_email" />

        </div>

    </div>

</x-forms.section>
