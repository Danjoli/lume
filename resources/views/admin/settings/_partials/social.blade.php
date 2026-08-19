<x-forms.section
    title="Redes sociais"
    description="Links das redes sociais da Lume."
>

    <div class="grid gap-6 md:grid-cols-2">

        @foreach([
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'youtube' => 'YouTube',
            'tiktok' => 'TikTok',
            'linkedin' => 'LinkedIn',
        ] as $field => $label)

            <div>

                <x-forms.label :for="$field">
                    {{ $label }}
                </x-forms.label>

                <x-forms.input
                    :id="$field"
                    :name="$field"
                    type="url"
                    :value="old($field, $settings->{$field})"
                />

                <x-forms.error :field="$field" />

            </div>

        @endforeach

    </div>

</x-forms.section>
