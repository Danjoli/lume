<x-forms.form
    :action="isset($publisher)
        ? route('admin.publishers.update', $publisher)
        : route('admin.publishers.store')"

    :method="isset($publisher)
        ? 'PUT'
        : 'POST'"
>

    <x-forms.section
        title="Informações Gerais"
        description="Dados principais da editora."
    >

        <div>

            <x-forms.label
                for="name"
                required
            >

                Nome

            </x-forms.label>

            <x-forms.input
                id="name"
                name="name"
                :value="$publisher->name ?? ''"
            />

            <x-forms.error field="name" />

        </div>

        <div>

            <x-forms.label
                for="slug"
            >

                Slug

            </x-forms.label>

            <x-forms.input
                id="slug"
                name="slug"
                :value="$publisher->slug ?? ''"
            />

            <x-forms.error field="slug" />

        </div>

        <div>

            <x-forms.label
                for="description"
            >

                Descrição

            </x-forms.label>

            <x-forms.textarea
                id="description"
                name="description"
                rows="6"
                :value="$publisher->description ?? ''"
            />

            <x-forms.error field="description" />

        </div>

    </x-forms.section>

    <x-forms.actions>

        <x-buttons.secondary-button
            :href="route('admin.publishers.index')"
        >

            Cancelar

        </x-buttons.secondary-button>

        <x-buttons.primary-button
            type="submit"
        >

            {{ isset($publisher) ? 'Atualizar' : 'Salvar' }}

        </x-buttons.primary-button>

    </x-forms.actions>

</x-forms.form>
