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
        Sobre o livro
    </h2>

    <div
        class="
            mt-5 whitespace-pre-line
            text-sm leading-7
            text-[#5E6965]
        "
    >
        {{ $book->description ?: 'Descrição não informada.' }}
    </div>

</section>
