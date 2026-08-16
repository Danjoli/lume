<x-admin.app-layout :title="$book->title">

    <div class="space-y-8">

        <x-admin.headers.page-header :title="$book->title" description="Visualize todas as informações do livro.">

            <div class="flex gap-3">

                <x-buttons.secondary-button :href="route('admin.books.index')">

                    Voltar

                </x-buttons.secondary-button>

                <x-buttons.primary-button :href="route('admin.books.edit', $book)">

                    Editar

                </x-buttons.primary-button>

            </div>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        {{-- Informações Gerais --}}
        <x-admin.cards.details-card>

            <div>

                <dt class="text-sm font-medium text-slate-500">

                    Título

                </dt>

                <dd class="mt-1">

                    {{ $book->title }}

                </dd>

            </div>

            <div>

                <dt class="text-sm font-medium text-slate-500">

                    Slug

                </dt>

                <dd class="mt-1">

                    {{ $book->slug }}

                </dd>

            </div>

            <div>

                <dt class="text-sm font-medium text-slate-500">

                    ISBN

                </dt>

                <dd class="mt-1">

                    {{ $book->isbn }}

                </dd>

            </div>

            <div>

                <dt class="text-sm font-medium text-slate-500">

                    SKU

                </dt>

                <dd class="mt-1">

                    {{ $book->sku }}

                </dd>

            </div>

            <div class="md:col-span-2">

                <dt class="text-sm font-medium text-slate-500">

                    Resumo

                </dt>

                <dd class="mt-1 whitespace-pre-line">

                    {{ $book->summary ?: 'Não informado.' }}

                </dd>

            </div>

            <div class="md:col-span-2">

                <dt class="text-sm font-medium text-slate-500">

                    Descrição

                </dt>

                <dd class="mt-1 whitespace-pre-line">

                    {{ $book->description ?: 'Não informado.' }}

                </dd>

            </div>

        </x-admin.cards.details-card>

        {{-- Publicação --}}
        <x-admin.cards.details-card>

            <div>

                <dt>Editora</dt>

                <dd>{{ $book->publisher?->name }}</dd>

            </div>

            <div>

                <dt>Idioma</dt>

                <dd>{{ $book->language }}</dd>

            </div>

            <div>

                <dt>Páginas</dt>

                <dd>{{ $book->pages }}</dd>

            </div>

            <div>

                <dt>Ano</dt>

                <dd>{{ $book->publication_year }}</dd>

            </div>

            <div>

                <dt>Publicado em</dt>

                <dd>

                    {{ optional($book->published_at)->format('d/m/Y') }}

                </dd>

            </div>

        </x-admin.cards.details-card>

        {{-- Preços --}}
        <x-admin.cards.details-card>

            <div>

                <dt>Preço</dt>

                <dd>

                    R$ {{ number_format($book->price, 2, ',', '.') }}

                </dd>

            </div>

            <div>

                <dt>Preço Promocional</dt>

                <dd>

                    {{ $book->sale_price ? 'R$ ' . number_format($book->sale_price, 2, ',', '.') : '-' }}

                </dd>

            </div>

        </x-admin.cards.details-card>

        {{-- Estoque --}}
        <x-admin.cards.details-card>

            <div>

                <dt>Quantidade</dt>

                <dd>

                    {{ $book->stock }}

                </dd>

            </div>

            <div>

                <dt>Status</dt>

                <dd>

                    <x-badges.status-badge :status="$book->status" />

                </dd>

            </div>

            <div>

                <dt>Destaque</dt>

                <dd>

                    {{ $book->featured ? 'Sim' : 'Não' }}

                </dd>

            </div>

            <div>

                <dt>Pré-venda</dt>

                <dd>

                    {{ $book->pre_order ? 'Sim' : 'Não' }}

                </dd>

            </div>

        </x-admin.cards.details-card>

        {{-- Autores --}}
        <x-admin.cards.card>

            <h2 class="mb-4 text-lg font-semibold">

                Autores

            </h2>

            <div class="flex flex-wrap gap-2">

                @foreach ($book->authors as $author)
                    <x-badges.badge>

                        {{ $author->name }}

                    </x-badges.badge>
                @endforeach

            </div>

        </x-admin.cards.card>

        {{-- Categorias --}}
        <x-admin.cards.card>

            <h2 class="mb-4 text-lg font-semibold">

                Categorias

            </h2>

            <div class="flex flex-wrap gap-2">

                @foreach ($book->categories as $category)
                    <x-badges.badge>

                        {{ $category->name }}

                    </x-badges.badge>
                @endforeach

            </div>

        </x-admin.cards.card>

        {{-- Imagens --}}
        <x-admin.cards.card>

            <h2 class="mb-4 text-lg font-semibold">

                Imagens

            </h2>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                @if ($book->cover)
                    <img src="{{ Storage::url($book->cover) }}" class="aspect-[3/4] rounded-lg border object-cover"
                        alt="{{ $book->title }}">
                @endif

                @foreach ($book->images as $image)
                    <img src="{{ Storage::url($image->path) }}" class="aspect-[3/4] rounded-lg border object-cover"
                        alt="">
                @endforeach

            </div>

        </x-admin.cards.card>

        {{-- SEO --}}
        <x-admin.cards.details-card>

            <div>

                <dt>Meta Title</dt>

                <dd>

                    {{ $book->meta_title ?: '-' }}

                </dd>

            </div>

            <div class="md:col-span-2">

                <dt>Meta Description</dt>

                <dd>

                    {{ $book->meta_description ?: '-' }}

                </dd>

            </div>

            <div class="md:col-span-2">

                <dt>Meta Keywords</dt>

                <dd>

                    {{ $book->meta_keywords ?: '-' }}

                </dd>

            </div>

        </x-admin.cards.details-card>

    </div>

</x-admin.app-layout>
