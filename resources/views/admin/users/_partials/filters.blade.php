<x-admin.cards.card>

    <form method="GET" action="{{ route('admin.users.index') }}">

        <div class="grid gap-4 lg:grid-cols-4">

            <div class="lg:col-span-2">

                <x-forms.label for="search">

                    Pesquisar

                </x-forms.label>

                <x-forms.search id="search" name="search" placeholder="Nome ou e-mail..." />

            </div>

            <div>

                <x-forms.label for="status">

                    Status

                </x-forms.label>

                <x-forms.select id="status" name="status">

                    <option value="">

                        Todos

                    </option>

                    <option value="active" @selected(request('status') == 'active')>

                        Ativo

                    </option>

                    <option value="inactive" @selected(request('status') == 'inactive')>

                        Inativo

                    </option>

                </x-forms.select>

            </div>

            <div class="flex items-end gap-3">

                <x-buttons.primary-button type="submit">

                    Filtrar

                </x-buttons.primary-button>

                <x-buttons.secondary-button :href="route('admin.users.index')">

                    Limpar

                </x-buttons.secondary-button>

            </div>

        </div>

    </form>

</x-admin.cards.card>
