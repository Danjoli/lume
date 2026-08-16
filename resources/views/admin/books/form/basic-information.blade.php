<x-forms.section
    title="Informações Gerais"
    description="Dados principais do livro."
>

    <div class="grid gap-6 md:grid-cols-2">

        <div class="md:col-span-2">

            <x-forms.label
                for="title"
                required
            >

                Título

            </x-forms.label>

            <x-forms.input
                id="title"
                name="title"
                :value="old('title', $book->title ?? '')"
            />

            <x-forms.error field="title"/>

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
                :value="old('slug', $book->slug ?? '')"
            />

            <x-forms.error field="slug"/>

        </div>

        <div>

            <x-forms.label
                for="isbn"
                required
            >

                ISBN

            </x-forms.label>

            <x-forms.input
                id="isbn"
                name="isbn"
                :value="old('isbn', $book->isbn ?? '')"
            />

            <x-forms.error field="isbn"/>

        </div>

        <div class="md:col-span-2">

            <x-forms.label
                for="summary"
            >

                Resumo

            </x-forms.label>

            <x-forms.textarea
                id="summary"
                name="summary"
                rows="4"
                :value="old('summary', $book->summary ?? '')"
            />

            <x-forms.error field="summary"/>

        </div>

        <div class="md:col-span-2">

            <x-forms.label
                for="description"
            >

                Descrição Completa

            </x-forms.label>

            <x-forms.textarea
                id="description"
                name="description"
                rows="10"
                :value="old('description', $book->description ?? '')"
            />

            <x-forms.error field="description"/>

        </div>

    </div>

</x-forms.section>
