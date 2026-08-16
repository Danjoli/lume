<x-forms.form
    :action="isset($coupon)
        ? route('admin.coupons.update', $coupon)
        : route('admin.coupons.store')"
    :method="isset($coupon) ? 'PUT' : 'POST'"
>

    <x-forms.section
        title="Informações do Cupom"
        description="Configure o desconto."
    >

        <div class="grid gap-6 md:grid-cols-2">

            <div>

                <x-forms.label
                    for="code"
                    required
                >

                    Código

                </x-forms.label>

                <x-forms.input
                    id="code"
                    name="code"
                    :value="old('code', $coupon->code ?? '')"
                />

                <x-forms.error field="code"/>

            </div>

            <div>

                <x-forms.label
                    for="type"
                    required
                >

                    Tipo

                </x-forms.label>

                <x-forms.select
                    id="type"
                    name="type"
                >

                    <option value="fixed">

                        Valor Fixo

                    </option>

                    <option value="percentage">

                        Percentual

                    </option>

                </x-forms.select>

            </div>

            <div>

                <x-forms.label
                    for="value"
                    required
                >

                    Valor

                </x-forms.label>

                <x-forms.input
                    id="value"
                    type="number"
                    step="0.01"
                    name="value"
                    :value="old('value', $coupon->value ?? '')"
                />

            </div>

            <div>

                <x-forms.label
                    for="minimum_amount"
                >

                    Compra Mínima

                </x-forms.label>

                <x-forms.input
                    id="minimum_amount"
                    type="number"
                    step="0.01"
                    name="minimum_amount"
                    :value="old('minimum_amount', $coupon->minimum_amount ?? '')"
                />

            </div>

            <div>

                <x-forms.label
                    for="usage_limit"
                >

                    Limite de Uso

                </x-forms.label>

                <x-forms.input
                    id="usage_limit"
                    type="number"
                    name="usage_limit"
                    :value="old('usage_limit', $coupon->usage_limit ?? '')"
                />

            </div>

            <div>

                <x-forms.label
                    for="expires_at"
                >

                    Expira em

                </x-forms.label>

                <x-forms.input
                    id="expires_at"
                    type="date"
                    name="expires_at"
                    :value="old('expires_at', optional($coupon->expires_at ?? null)->format('Y-m-d'))"
                />

            </div>

            <div class="md:col-span-2">

                <x-forms.switch
                    id="active"
                    name="active"
                    :checked="old('active', $coupon->active ?? true)"
                >

                    Cupom ativo

                </x-forms.switch>

            </div>

        </div>

    </x-forms.section>

    <x-forms.actions>

        <x-buttons.secondary-button
            :href="route('admin.coupons.index')"
        >

            Cancelar

        </x-buttons.secondary-button>

        <x-buttons.primary-button
            type="submit"
        >

            {{ isset($coupon) ? 'Atualizar' : 'Salvar' }}

        </x-buttons.primary-button>

    </x-forms.actions>

</x-forms.form>
