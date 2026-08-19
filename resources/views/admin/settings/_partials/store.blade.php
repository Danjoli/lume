<x-forms.section
    title="Loja"
    description="Informações principais da Lume."
>

    <div class="grid gap-6 md:grid-cols-2">

        <div>

            <x-forms.label for="store_name" required>
                Nome da loja
            </x-forms.label>

            <x-forms.input
                id="store_name"
                name="store_name"
                :value="old('store_name', $settings->store_name)"
                required
            />

            <x-forms.error field="store_name" />

        </div>

        <div>

            <x-forms.label for="company_name">
                Razão social
            </x-forms.label>

            <x-forms.input
                id="company_name"
                name="company_name"
                :value="old('company_name', $settings->company_name)"
            />

            <x-forms.error field="company_name" />

        </div>

        <div>

            <x-forms.label for="cnpj">
                CNPJ
            </x-forms.label>

            <x-forms.input
                id="cnpj"
                name="cnpj"
                :value="old('cnpj', $settings->cnpj)"
            />

            <x-forms.error field="cnpj" />

        </div>

        <div class="md:col-span-2">

            <x-forms.label for="description">
                Descrição da loja
            </x-forms.label>

            <textarea
                id="description"
                name="description"
                rows="4"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
            >{{ old('description', $settings->description) }}</textarea>

            <x-forms.error field="description" />

        </div>

    </div>

</x-forms.section>
