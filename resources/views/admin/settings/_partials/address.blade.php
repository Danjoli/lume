<x-forms.section
    title="Endereço"
    description="Endereço comercial da loja."
>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

        <div>

            <x-forms.label for="cep">
                CEP
            </x-forms.label>

            <x-forms.input
                id="cep"
                name="cep"
                :value="old('cep', $settings->cep)"
            />

            <x-forms.error field="cep" />

        </div>

        <div class="lg:col-span-2">

            <x-forms.label for="street">
                Rua
            </x-forms.label>

            <x-forms.input
                id="street"
                name="street"
                :value="old('street', $settings->street)"
            />

            <x-forms.error field="street" />

        </div>

        <div>

            <x-forms.label for="number">
                Número
            </x-forms.label>

            <x-forms.input
                id="number"
                name="number"
                :value="old('number', $settings->number)"
            />

            <x-forms.error field="number" />

        </div>

        <div>

            <x-forms.label for="complement">
                Complemento
            </x-forms.label>

            <x-forms.input
                id="complement"
                name="complement"
                :value="old('complement', $settings->complement)"
            />

            <x-forms.error field="complement" />

        </div>

        <div>

            <x-forms.label for="neighborhood">
                Bairro
            </x-forms.label>

            <x-forms.input
                id="neighborhood"
                name="neighborhood"
                :value="old('neighborhood', $settings->neighborhood)"
            />

            <x-forms.error field="neighborhood" />

        </div>

        <div>

            <x-forms.label for="city">
                Cidade
            </x-forms.label>

            <x-forms.input
                id="city"
                name="city"
                :value="old('city', $settings->city)"
            />

            <x-forms.error field="city" />

        </div>

        <div>

            <x-forms.label for="state">
                Estado
            </x-forms.label>

            <x-forms.input
                id="state"
                name="state"
                maxlength="2"
                :value="old('state', $settings->state)"
            />

            <x-forms.error field="state" />

        </div>

    </div>

</x-forms.section>
