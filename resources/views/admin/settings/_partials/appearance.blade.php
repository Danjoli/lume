<x-forms.section
    title="Aparência"
    description="Identidade visual da loja."
>

    <div class="grid gap-6 md:grid-cols-2">

        <div>

            <x-forms.label for="logo">
                Logo
            </x-forms.label>

            <input
                id="logo"
                type="file"
                name="logo"
                accept="image/*"
                class="w-full rounded-xl border border-slate-300 bg-white p-3 text-sm"
            >

            <x-forms.error field="logo" />

            @if($settings->logo)

                <img
                    src="{{ Storage::url($settings->logo) }}"
                    alt="Logo da Lume"
                    class="mt-4 h-16 w-auto"
                >

            @endif

        </div>

        <div>

            <x-forms.label for="favicon">
                Favicon
            </x-forms.label>

            <input
                id="favicon"
                type="file"
                name="favicon"
                accept="image/*"
                class="w-full rounded-xl border border-slate-300 bg-white p-3 text-sm"
            >

            <x-forms.error field="favicon" />

            @if($settings->favicon)

                <img
                    src="{{ Storage::url($settings->favicon) }}"
                    alt="Favicon da Lume"
                    class="mt-4 h-10 w-10"
                >

            @endif

        </div>

    </div>

</x-forms.section>
