@props([
    'title',
    'href' => null,
])

<div class="mb-5 flex items-center justify-between">

    <h2 class="text-lg font-bold text-[#13211F]">
        {{ $title }}
    </h2>

    @if($href)

        <a
            href="{{ $href }}"
            class="
                flex items-center gap-1
                text-xs font-medium text-[#53615E]
                transition hover:text-[#062B25]
            "
        >
            Ver todos

            <x-heroicon-o-chevron-right class="h-4 w-4" />
        </a>

    @endif

</div>
