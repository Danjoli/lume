<x-forms.section
    title="Geral"
    description="Informações básicas da loja."
>

    <div class="grid gap-6 md:grid-cols-2">

        <div>

            <x-forms.label
                for="store_name"
                required
            >

                Nome da Loja

            </x-forms.label>

            <x-forms.input
                id="store_name"
                name="store_name"
                :value="old('store_name', $settings->store_name)"
            />

        </div>

        <div>

            <x-forms.label
                for="store_email"
            >

                E-mail

            </x-forms.label>

            <x-forms.input
                id="store_email"
                type="email"
                name="store_email"
                :value="old('store_email', $settings->store_email)"
            />

        </div>

        <div>

            <x-forms.label
                for="store_phone"
            >

                Telefone

            </x-forms.label>

            <x-forms.input
                id="store_phone"
                name="store_phone"
                :value="old('store_phone', $settings->store_phone)"
            />

        </div>

        <div>

            <x-forms.label
                for="store_logo"
            >

                Logo

            </x-forms.label>

            <x-forms.file-input
                id="store_logo"
                name="store_logo"
            />

        </div>

    </div>

</x-forms.section>
