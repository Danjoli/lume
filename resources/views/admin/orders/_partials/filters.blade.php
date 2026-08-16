<x-admin.cards.card>

    <form action="{{ route('admin.orders.index') }}" method="GET">

        <div class="grid gap-6 lg:grid-cols-6">

            <div class="lg:col-span-2">

                <x-forms.label for="search">

                    Pesquisar

                </x-forms.label>

                <x-forms.search id="search" name="search" placeholder="Pedido, cliente ou e-mail..." />

            </div>

            <div>

                <x-forms.label for="status">

                    Status

                </x-forms.label>

                <x-forms.select id="status" name="status">

                    <option value="">Todos</option>

                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}" @selected(request('status') == $status->value)>

                            {{ $status->label() }}

                        </option>
                    @endforeach

                </x-forms.select>

            </div>

            <div>

                <x-forms.label for="payment_status">

                    Pagamento

                </x-forms.label>

                <x-forms.select id="payment_status" name="payment_status">

                    <option value="">Todos</option>

                    @foreach ($paymentStatuses as $status)
                        <option value="{{ $status->value }}" @selected(request('payment_status') == $status->value)>

                            {{ $status->label() }}

                        </option>
                    @endforeach

                </x-forms.select>

            </div>

            <div>

                <x-forms.label for="shipment_status">

                    Envio

                </x-forms.label>

                <x-forms.select id="shipment_status" name="shipment_status">

                    <option value="">Todos</option>

                    @foreach ($shipmentStatuses as $status)
                        <option value="{{ $status->value }}" @selected(request('shipment_status') == $status->value)>

                            {{ $status->label() }}

                        </option>
                    @endforeach

                </x-forms.select>

            </div>

            <div>

                <x-forms.label for="date">

                    Data

                </x-forms.label>

                <x-forms.input id="date" type="date" name="date" :value="request('date')" />

            </div>

        </div>

        <div class="mt-6 flex justify-end gap-3">

            <x-buttons.secondary-button :href="route('admin.orders.index')">

                Limpar

            </x-buttons.secondary-button>

            <x-buttons.primary-button type="submit">

                Filtrar

            </x-buttons.primary-button>

        </div>

    </form>

</x-admin.cards.card>
