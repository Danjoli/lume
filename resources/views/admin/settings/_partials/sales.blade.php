<x-forms.section
    title="Vendas"
    description="Regras gerais para compras na loja."
>

    <div class="grid gap-6 md:grid-cols-3">

        <div>

            <x-forms.label for="minimum_order_amount">
                Pedido mínimo
            </x-forms.label>

            <x-forms.input
                id="minimum_order_amount"
                name="minimum_order_amount"
                type="number"
                step="0.01"
                min="0"
                :value="old(
                    'minimum_order_amount',
                    $settings->minimum_order_amount
                )"
            />

            <x-forms.error field="minimum_order_amount" />

        </div>

        <div>

            <x-forms.label for="currency">
                Moeda
            </x-forms.label>

            <x-forms.select
                id="currency"
                name="currency"
            >
                <option
                    value="BRL"
                    @selected(old('currency', $settings->currency) === 'BRL')
                >
                    Real brasileiro (BRL)
                </option>
            </x-forms.select>

            <x-forms.error field="currency" />

        </div>

        <div class="flex items-end">

            <label class="flex items-center gap-3">

                <input
                    type="checkbox"
                    name="allow_out_of_stock_sales"
                    value="1"
                    @checked(
                        old(
                            'allow_out_of_stock_sales',
                            $settings->allow_out_of_stock_sales
                        )
                    )
                >

                <span class="text-sm text-slate-700">
                    Permitir venda sem estoque
                </span>

            </label>

        </div>

    </div>

</x-forms.section>
