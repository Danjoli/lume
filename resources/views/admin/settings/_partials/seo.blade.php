<x-forms.section
    title="SEO"
    description="Configurações para mecanismos de busca."
>

    <div class="space-y-6">

        <div>

            <x-forms.label>

                Meta Title

            </x-forms.label>

            <x-forms.input
                name="meta_title"
                :value="$settings->meta_title"
            />

        </div>

        <div>

            <x-forms.label>

                Meta Description

            </x-forms.label>

            <x-forms.textarea
                name="meta_description"
                rows="4"
            >

                {{ old('meta_description', $settings->meta_description) }}

            </x-forms.textarea>

        </div>

        <div>

            <x-forms.label>

                Meta Keywords

            </x-forms.label>

            <x-forms.input
                name="meta_keywords"
                :value="$settings->meta_keywords"
            />

        </div>

    </div>

</x-forms.section>
