<x-forms.section
    title="SEO"
    description="Informações para mecanismos de busca."
>

    <div class="grid gap-6">

        <div>

            <x-forms.label
                for="meta_title"
            >

                Meta Title

            </x-forms.label>

            <x-forms.input
                id="meta_title"
                name="meta_title"
                :value="old('meta_title', $book->meta_title ?? '')"
            />

            <x-forms.error field="meta_title"/>

        </div>

        <div>

            <x-forms.label
                for="meta_description"
            >

                Meta Description

            </x-forms.label>

            <x-forms.textarea
                id="meta_description"
                name="meta_description"
                rows="4"
                :value="old('meta_description', $book->meta_description ?? '')"
            />

            <x-forms.error field="meta_description"/>

        </div>

        <div>

            <x-forms.label
                for="meta_keywords"
            >

                Meta Keywords

            </x-forms.label>

            <x-forms.input
                id="meta_keywords"
                name="meta_keywords"
                :value="old('meta_keywords', $book->meta_keywords ?? '')"
            />

            <x-forms.error field="meta_keywords"/>

            <p class="mt-2 text-sm text-slate-500">

                Separe as palavras-chave por vírgula.

            </p>

        </div>

    </div>

</x-forms.section>
