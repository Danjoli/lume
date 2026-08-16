<x-forms.section
    title="Estoque"
    description="Controle de estoque e disponibilidade."
>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

        <div>

            <x-forms.label
                for="sku"
            >

                SKU

            </x-forms.label>

            <x-forms.input
                id="sku"
                name="sku"
                :value="old('sku', $book->sku ?? '')"
            />

            <x-forms.error field="sku"/>

        </div>

        <div>

            <x-forms.label
                for="stock"
                required
            >

                Quantidade

            </x-forms.label>

            <x-forms.input
                id="stock"
                name="stock"
                type="number"
                min="0"
                :value="old('stock', $book->stock ?? 0)"
            />

            <x-forms.error field="stock"/>

        </div>

        <div>

            <x-forms.label
                for="status"
            >

                Status

            </x-forms.label>

            <x-forms.select
                id="status"
                name="status"
            >

                <option
                    value="draft"
                    @selected(old('status', $book->status ?? 'draft') == 'draft')
                >

                    Rascunho

                </option>

                <option
                    value="published"
                    @selected(old('status', $book->status ?? '') == 'published')
                >

                    Publicado

                </option>

                <option
                    value="archived"
                    @selected(old('status', $book->status ?? '') == 'archived')
                >

                    Arquivado

                </option>

            </x-forms.select>

            <x-forms.error field="status"/>

        </div>

        <div class="space-y-5">

            <x-forms.switch
                id="featured"
                name="featured"
                :checked="old('featured', $book->featured ?? false)"
            >

                Livro em destaque

            </x-forms.switch>

            <x-forms.switch
                id="pre_order"
                name="pre_order"
                :checked="old('pre_order', $book->pre_order ?? false)"
            >

                Pré-venda

            </x-forms.switch>

        </div>

    </div>

</x-forms.section>
