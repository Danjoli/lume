<x-admin.cards.card>

    <form action="{{ route('admin.notifications.index') }}" method="GET">

        <div class="grid gap-6 lg:grid-cols-4">

            <div class="lg:col-span-2">

                <x-forms.label for="search">

                    Pesquisar

                </x-forms.label>

                <x-forms.search id="search" name="search" placeholder="Título..." />

            </div>

            <div>

                <x-forms.label for="read">

                    Status

                </x-forms.label>

                <x-forms.select id="read" name="read">

                    <option value="">

                        Todas

                    </option>

                    <option value="1">

                        Lidas

                    </option>

                    <option value="0">

                        Não lidas

                    </option>

                </x-forms.select>

            </div>

            <div class="flex items-end gap-3">

                <x-buttons.secondary-button :href="route('admin.notifications.index')">

                    Limpar

                </x-buttons.secondary-button>

                <x-buttons.primary-button type="submit">

                    Filtrar

                </x-buttons.primary-button>

            </div>

        </div>

    </form>

</x-admin.cards.card>
