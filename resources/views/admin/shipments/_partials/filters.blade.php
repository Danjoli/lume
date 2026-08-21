<x-admin.cards.card content-class="p-4">

    <form method="GET" action="{{ route('admin.shipments.index') }}">

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">

            <div class="lg:col-span-2">

                <x-forms.label for="search">

                    Pesquisar

                </x-forms.label>

                <x-forms.search id="search" name="search" placeholder="Pedido, cliente ou rastreamento..." />

            </div>

            <div>

                <x-forms.label for="status">

                    Status

                </x-forms.label>

                <x-forms.select id="status" name="status">

                    <option value="">

                        Todos

                    </option>

                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}" @selected(request('status') == $status->value)>

                            {{ $status->label() }}

                        </option>
                    @endforeach

                </x-forms.select>

            </div>

            <div>

                <x-forms.label for="carrier">

                    Transportadora

                </x-forms.label>

                <x-forms.select id="carrier" name="carrier">

                    <option value="">

                        Todas

                    </option>

                    @foreach ($carriers as $carrier)
                        <option value="{{ $carrier }}" @selected(request('carrier') == $carrier)>

                            {{ $carrier }}

                        </option>
                    @endforeach

                </x-forms.select>

            </div>

            <div class="flex items-end gap-3">

                <x-buttons.secondary-button :href="route('admin.shipments.index')">

                    Limpar

                </x-buttons.secondary-button>

                <x-buttons.primary-button type="submit">

                    Filtrar

                </x-buttons.primary-button>

            </div>

        </div>

    </form>

</x-admin.cards.card>
