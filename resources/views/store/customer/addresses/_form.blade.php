<div class="grid gap-5 md:grid-cols-2">

    <div>

        <x-forms.label for="label">
            Nome do endereço
        </x-forms.label>

        <x-forms.input
            id="label"
            name="label"
            :value="old('label', $address->label ?? '')"
            placeholder="Ex.: Casa, Trabalho"
        />

        <x-forms.error field="label" />

    </div>

    <div>

        <x-forms.label for="recipient_name" required>
            Destinatário
        </x-forms.label>

        <x-forms.input
            id="recipient_name"
            name="recipient_name"
            :value="old(
                'recipient_name',
                $address->recipient_name ?? auth()->user()->name
            )"
            required
        />

        <x-forms.error field="recipient_name" />

    </div>

    <div>

        <x-forms.label for="phone" required>
            Telefone
        </x-forms.label>

        <x-forms.input
            id="phone"
            name="phone"
            :value="old('phone', $address->phone ?? '')"
            required
        />

        <x-forms.error field="phone" />

    </div>

    <div>

        <x-forms.label for="cep" required>
            CEP
        </x-forms.label>

        <x-forms.input
            id="cep"
            name="cep"
            :value="old('cep', $address->cep ?? '')"
            required
        />

        <x-forms.error field="cep" />

    </div>

    <div class="md:col-span-2">

        <x-forms.label for="street" required>
            Rua
        </x-forms.label>

        <x-forms.input
            id="street"
            name="street"
            :value="old('street', $address->street ?? '')"
            required
        />

        <x-forms.error field="street" />

    </div>

    <div>

        <x-forms.label for="number" required>
            Número
        </x-forms.label>

        <x-forms.input
            id="number"
            name="number"
            :value="old('number', $address->number ?? '')"
            required
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
            :value="old('complement', $address->complement ?? '')"
        />

        <x-forms.error field="complement" />

    </div>

    <div>

        <x-forms.label for="neighborhood" required>
            Bairro
        </x-forms.label>

        <x-forms.input
            id="neighborhood"
            name="neighborhood"
            :value="old(
                'neighborhood',
                $address->neighborhood ?? ''
            )"
            required
        />

        <x-forms.error field="neighborhood" />

    </div>

    <div>

        <x-forms.label for="city" required>
            Cidade
        </x-forms.label>

        <x-forms.input
            id="city"
            name="city"
            :value="old('city', $address->city ?? '')"
            required
        />

        <x-forms.error field="city" />

    </div>

    <div>

        <x-forms.label for="state" required>
            Estado
        </x-forms.label>

        <x-forms.input
            id="state"
            name="state"
            maxlength="2"
            :value="old('state', $address->state ?? '')"
            placeholder="SP"
            required
        />

        <x-forms.error field="state" />

    </div>

    <div class="flex items-end">

        <label class="flex items-center gap-3">

            <input
                type="checkbox"
                name="is_default"
                value="1"
                @checked(
                    old(
                        'is_default',
                        $address->is_default ?? false
                    )
                )
            >

            <span class="text-sm text-[#52605C]">
                Definir como endereço principal
            </span>

        </label>

    </div>

</div>
