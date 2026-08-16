<x-forms.section
    title="Loja"
    description="Configurações da loja."
>

    <div class="grid gap-6 md:grid-cols-3">

        <div>

            <x-forms.label for="currency">

                Moeda

            </x-forms.label>

            <x-forms.select
                id="currency"
                name="currency"
            >

                <option value="BRL">

                    Real (BRL)

                </option>

                <option value="USD">

                    Dólar (USD)

                </option>

            </x-forms.select>

        </div>

        <div>

            <x-forms.label for="locale">

                Idioma

            </x-forms.label>

            <x-forms.select
                id="locale"
                name="locale"
            >

                <option value="pt_BR">

                    Português

                </option>

                <option value="en">

                    English

                </option>

            </x-forms.select>

        </div>

        <div>

            <x-forms.label for="timezone">

                Timezone

            </x-forms.label>

            <x-forms.input
                id="timezone"
                name="timezone"
                :value="old('timezone', $settings->timezone)"
            />

        </div>

    </div>

</x-forms.section>
