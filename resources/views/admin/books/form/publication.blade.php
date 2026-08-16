<x-forms.section
    title="Publicação"
    description="Informações editoriais do livro."
>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

        <div>

            <x-forms.label
                for="publisher_id"
                required
            >

                Editora

            </x-forms.label>

            <x-forms.select
                id="publisher_id"
                name="publisher_id"
            >

                <option value="">

                    Selecione

                </option>

                @foreach($publishers as $publisher)

                    <option
                        value="{{ $publisher->id }}"
                        @selected(old('publisher_id', $book->publisher_id ?? '') == $publisher->id)
                    >

                        {{ $publisher->name }}

                    </option>

                @endforeach

            </x-forms.select>

            <x-forms.error field="publisher_id"/>

        </div>

        <div>

            <x-forms.label
                for="language"
            >

                Idioma

            </x-forms.label>

            <x-forms.input
                id="language"
                name="language"
                :value="old('language', $book->language ?? '')"
            />

            <x-forms.error field="language"/>

        </div>

        <div>

            <x-forms.label
                for="publication_year"
            >

                Ano

            </x-forms.label>

            <x-forms.input
                id="publication_year"
                type="number"
                name="publication_year"
                :value="old('publication_year', $book->publication_year ?? '')"
            />

            <x-forms.error field="publication_year"/>

        </div>

        <div>

            <x-forms.label
                for="pages"
            >

                Páginas

            </x-forms.label>

            <x-forms.input
                id="pages"
                type="number"
                name="pages"
                :value="old('pages', $book->pages ?? '')"
            />

            <x-forms.error field="pages"/>

        </div>

        <div>

            <x-forms.label
                for="published_at"
            >

                Data de Publicação

            </x-forms.label>

            <x-forms.input
                id="published_at"
                type="date"
                name="published_at"
                :value="old(
                    'published_at',
                    isset($book)
                        ? optional($book->published_at)->format('Y-m-d')
                        : ''
                )"
            />

            <x-forms.error field="published_at"/>

        </div>

    </div>

</x-forms.section>
