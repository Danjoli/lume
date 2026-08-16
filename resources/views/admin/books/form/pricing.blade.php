<x-forms.section
    title="Preços"
    description="Configure os preços do livro."
>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

        <div>

            <x-forms.label
                for="price"
                required
            >

                Preço

            </x-forms.label>

            <x-forms.input
                id="price"
                name="price"
                type="number"
                step="0.01"
                min="0"
                :value="old('price', $book->price ?? '')"
            />

            <x-forms.error field="price"/>

        </div>

        <div>

            <x-forms.label
                for="sale_price"
            >

                Preço Promocional

            </x-forms.label>

            <x-forms.input
                id="sale_price"
                name="sale_price"
                type="number"
                step="0.01"
                min="0"
                :value="old('sale_price', $book->sale_price ?? '')"
            />

            <x-forms.error field="sale_price"/>

        </div>

        <div>

            <x-forms.label
                for="sale_starts_at"
            >

                Início da Promoção

            </x-forms.label>

            <x-forms.input
                id="sale_starts_at"
                type="date"
                name="sale_starts_at"
                :value="old(
                    'sale_starts_at',
                    isset($book)
                        ? optional($book->sale_starts_at)->format('Y-m-d')
                        : ''
                )"
            />

            <x-forms.error field="sale_starts_at"/>

        </div>

        <div>

            <x-forms.label
                for="sale_ends_at"
            >

                Fim da Promoção

            </x-forms.label>

            <x-forms.input
                id="sale_ends_at"
                type="date"
                name="sale_ends_at"
                :value="old(
                    'sale_ends_at',
                    isset($book)
                        ? optional($book->sale_ends_at)->format('Y-m-d')
                        : ''
                )"
            />

            <x-forms.error field="sale_ends_at"/>

        </div>

    </div>

</x-forms.section>
