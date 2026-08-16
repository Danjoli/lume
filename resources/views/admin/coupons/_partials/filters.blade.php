<x-admin.cards.card>

    <form method="GET" action="{{ route('admin.coupons.index') }}">

        <div class="grid gap-6 lg:grid-cols-4">

            <div class="lg:col-span-2">

                <x-forms.label for="search">

                    Pesquisar

                </x-forms.label>

                <x-forms.search id="search" name="search" placeholder="Código do cupom..." />

            </div>

            <div>

                <x-forms.label for="status">

                    Status

                </x-forms.label>

                <x-forms.select id="status" name="status">

                    <option value="">

                        Todos

                    </option>

                    <option value="1" @selected(request('status') == '1')>

                        Ativo

                    </option>

                    <option value="0" @selected(request('status') == '0')>

                        Inativo

                    </option>

                </x-forms.select>

            </div>

            <div class="flex items-end gap-3">

                <x-buttons.secondary-button :href="route('admin.coupons.index')">

                    Limpar

                </x-buttons.secondary-button>

                <x-buttons.primary-button type="submit">

                    Filtrar

                </x-buttons.primary-button>

            </div>

        </div>

    </form>

</x-admin.cards.card>
