<x-forms.section
    title="Relacionamentos"
    description="Autores, categorias e editora."
>

    <div class="grid gap-6 md:grid-cols-2">

        <div>

            <x-forms.label
                for="authors"
                required
            >

                Autores

            </x-forms.label>

            <x-forms.select
                id="authors"
                name="authors[]"
                multiple
            >

                @foreach($authors as $author)

                    <option
                        value="{{ $author->id }}"
                        @selected(
                            collect(old(
                                'authors',
                                isset($book)
                                    ? $book->authors->pluck('id')->toArray()
                                    : []
                            ))->contains($author->id)
                        )
                    >

                        {{ $author->name }}

                    </option>

                @endforeach

            </x-forms.select>

            <x-forms.error field="authors"/>

        </div>

        <div>

            <x-forms.label
                for="categories"
                required
            >

                Categorias

            </x-forms.label>

            <x-forms.select
                id="categories"
                name="categories[]"
                multiple
            >

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        @selected(
                            collect(old(
                                'categories',
                                isset($book)
                                    ? $book->categories->pluck('id')->toArray()
                                    : []
                            ))->contains($category->id)
                        )
                    >

                        {{ $category->name }}

                    </option>

                @endforeach

            </x-forms.select>

            <x-forms.error field="categories"/>

        </div>

    </div>

</x-forms.section>
