<x-forms.section
    title="Contato"
    description="Canais de atendimento da loja."
>

    <div class="grid gap-6 md:grid-cols-3">

        <div>

            <x-forms.label for="email">
                E-mail
            </x-forms.label>

            <x-forms.input
                id="email"
                name="email"
                type="email"
                :value="old('email', $settings->email)"
            />

            <x-forms.error field="email" />

        </div>

        <div>

            <x-forms.label for="phone">
                Telefone
            </x-forms.label>

            <x-forms.input
                id="phone"
                name="phone"
                :value="old('phone', $settings->phone)"
            />

            <x-forms.error field="phone" />

        </div>

        <div>

            <x-forms.label for="whatsapp">
                WhatsApp
            </x-forms.label>

            <x-forms.input
                id="whatsapp"
                name="whatsapp"
                :value="old('whatsapp', $settings->whatsapp)"
            />

            <x-forms.error field="whatsapp" />

        </div>

    </div>

</x-forms.section>
