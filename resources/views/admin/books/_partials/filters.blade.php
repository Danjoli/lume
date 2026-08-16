<x-admin.cards.card>

    <form action="{{ route('admin.books.index') }}" method="GET">

        <div class="grid gap-4 lg:grid-cols-6">

            <div class="lg:col-span-2">

                <x-forms.label for="search">

                    Pesquisar

                </x-forms.label>

                <x-forms.search id="search" name="search" placeholder="Título, ISBN ou SKU..." />

            </div>

            <div>

                <x-forms.label for="category">

                    Categoria

                </x-forms.label>

                <x-forms.select id="category" name="category">

                    <option value="">

                        Todas

                    </option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category') == $category->id)>

                            {{ $category->name }}

                        </option>
                    @endforeach

                </x-forms.select>

            </div>

            <div>

                <x-forms.label for="author">

                    Autor

                </x-forms.label>

                <x-forms.select id="author" name="author">

                    <option value="">

                        Todos

                    </option>

                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" @selected(request('author') == $author->id)>

                            {{ $author->name }}

                        </option>
                    @endforeach

                </x-forms.select>

            </div>

            <div>

                <x-forms.label for="publisher">

                    Editora

                </x-forms.label>

                <x-forms.select id="publisher" name="publisher">

                    <option value="">

                        Todas

                    </option>

                    @foreach ($publishers as $publisher)
                        <option value="{{ $publisher->id }}" @selected(request('publisher') == $publisher->id)>

                            {{ $publisher->name }}

                        </option>
                    @endforeach

                </x-forms.select>

            </div>

            <div>

                <x-forms.label for="status">

                    Status

                </x-forms.label>

                <x-forms.select id="status" name="status">

                    <option value="">

                        Todos

                    </option>

                    <option value="published" @selected(request('status') == 'published')>

                        Publicado

                    </option>

                    <option value="draft" @selected(request('status') == 'draft')>

                        Rascunho

                    </option>

                </x-forms.select>

            </div>

        </div>

        <div class="mt-6 flex justify-end gap-3">

            <x-buttons.secondary-button :href="route('admin.books.index')">

                Limpar

            </x-buttons.secondary-button>

            <x-buttons.primary-button type="submit">

                Filtrar

            </x-buttons.primary-button>

        </div>

    </form>

</x-admin.cards.card>
