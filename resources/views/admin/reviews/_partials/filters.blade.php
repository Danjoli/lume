<x-admin.cards.card>

    <form method="GET" action="{{ route('admin.reviews.index') }}">

        <div class="grid gap-6 lg:grid-cols-4">

            <div class="lg:col-span-2">

                <x-forms.label for="search">

                    Pesquisar

                </x-forms.label>

                <x-forms.search id="search" name="search" placeholder="Livro ou usuário..." />

            </div>

            <div>

                <x-forms.label for="rating">

                    Nota

                </x-forms.label>

                <x-forms.select id="rating" name="rating">

                    <option value="">

                        Todas

                    </option>

                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(request('rating') == $i)>

                            {{ $i }} estrelas

                        </option>
                    @endfor

                </x-forms.select>

            </div>

            <div class="flex items-end gap-3">

                <x-buttons.secondary-button :href="route('admin.reviews.index')">

                    Limpar

                </x-buttons.secondary-button>

                <x-buttons.primary-button type="submit">

                    Filtrar

                </x-buttons.primary-button>

            </div>

        </div>

    </form>

</x-admin.cards.card>
