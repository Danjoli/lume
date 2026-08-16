<x-forms.form
    :action="isset($category)
        ? route('admin.categories.update', $category)
        : route('admin.categories.store')"

    :method="isset($category)
        ? 'PUT'
        : 'POST'"
>

    <x-forms.section
        title="Informações Gerais"
        description="Dados da categoria."
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
                :value="$category->name ?? ''"
            />

            <x-forms.error field="name"/>

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
                :value="$category->slug ?? ''"
            />

            <x-forms.error field="slug"/>

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
                :value="$category->description ?? ''"
            />

            <x-forms.error field="description"/>

        </div>

    </x-forms.section>

    <x-forms.actions>

        <x-buttons.secondary-button
            :href="route('admin.categories.index')"
        >

            Cancelar

        </x-buttons.secondary-button>

        <x-buttons.primary-button
            type="submit"
        >

            {{ isset($category) ? 'Atualizar' : 'Salvar' }}

        </x-buttons.primary-button>

    </x-forms.actions>

</x-forms.form>
