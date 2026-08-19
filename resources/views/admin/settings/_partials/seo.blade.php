<x-forms.section
    title="SEO"
    description="Informações padrão para mecanismos de busca."
>

    <div class="space-y-6">

        <div>

            <x-forms.label for="meta_title">
                Título padrão
            </x-forms.label>

            <x-forms.input
                id="meta_title"
                name="meta_title"
                :value="old('meta_title', $settings->meta_title)"
            />

            <x-forms.error field="meta_title" />

        </div>

        <div>

            <x-forms.label for="meta_description">
                Descrição padrão
            </x-forms.label>

            <textarea
                id="meta_description"
                name="meta_description"
                rows="4"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
            >{{ old('meta_description', $settings->meta_description) }}</textarea>

            <x-forms.error field="meta_description" />

        </div>

    </div>

</x-forms.section>
