@props([
    'book',
])

<section
    class="
        rounded-2xl border
        border-[#E5E3DE]
        bg-white p-7
    "
>

    <h2 class="text-xl font-bold text-[#17231F]">
        Detalhes do produto
    </h2>

    <dl
        class="
            mt-6 grid gap-x-10 gap-y-5
            sm:grid-cols-2
            lg:grid-cols-3
        "
    >

        <div>
            <dt class="text-xs text-[#7A837F]">
                Editora
            </dt>

            <dd class="mt-1 text-sm font-medium text-[#192722]">
                {{ $book->publisher?->name ?: '-' }}
            </dd>
        </div>

        <div>
            <dt class="text-xs text-[#7A837F]">
                ISBN
            </dt>

            <dd class="mt-1 text-sm font-medium text-[#192722]">
                {{ $book->isbn ?: '-' }}
            </dd>
        </div>

        <div>
            <dt class="text-xs text-[#7A837F]">
                Páginas
            </dt>

            <dd class="mt-1 text-sm font-medium text-[#192722]">
                {{ $book->pages ?: '-' }}
            </dd>
        </div>

        <div>
            <dt class="text-xs text-[#7A837F]">
                Idioma
            </dt>

            <dd class="mt-1 text-sm font-medium text-[#192722]">
                {{ $book->language ?: '-' }}
            </dd>
        </div>

        <div>
            <dt class="text-xs text-[#7A837F]">
                Edição
            </dt>

            <dd class="mt-1 text-sm font-medium text-[#192722]">
                {{ $book->edition ?: '-' }}
            </dd>
        </div>

        <div>
            <dt class="text-xs text-[#7A837F]">
                Formato
            </dt>

            <dd class="mt-1 text-sm font-medium text-[#192722]">
                {{ $book->format ?: '-' }}
            </dd>
        </div>

        <div>
            <dt class="text-xs text-[#7A837F]">
                Publicação
            </dt>

            <dd class="mt-1 text-sm font-medium text-[#192722]">
                {{ $book->publication_date?->format('d/m/Y') ?: '-' }}
            </dd>
        </div>

    </dl>

</section>
