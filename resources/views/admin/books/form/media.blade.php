<x-forms.section
    title="Mídia"
    description="Imagem principal e galeria."
>

    <div class="grid gap-6 md:grid-cols-2">

        <div>

            <x-forms.label
                for="cover"
            >

                Capa do Livro

            </x-forms.label>

            <x-forms.file-input
                id="cover"
                name="cover"
                accept="image/*"
            />

            <x-forms.error field="cover"/>

            @isset($book)

                @if($book->cover)

                    <img
                        src="{{ Storage::url($book->cover) }}"
                        alt="{{ $book->title }}"
                        class="mt-4 h-48 rounded-xl border object-cover"
                    >

                @endif

            @endisset

        </div>

        <div>

            <x-forms.label
                for="gallery"
            >

                Galeria

            </x-forms.label>

            <x-forms.file-input
                id="gallery"
                name="gallery[]"
                accept="image/*"
                multiple
            />

            <x-forms.error field="gallery"/>

            @isset($book)

                @if($book->images->count())

                    <div class="mt-4 grid grid-cols-3 gap-3">

                        @foreach($book->images as $image)

                            <img
                                src="{{ Storage::url($image->path) }}"
                                class="aspect-[3/4] rounded-lg border object-cover"
                                alt=""
                            >

                        @endforeach

                    </div>

                @endif

            @endisset

        </div>

    </div>

</x-forms.section>
