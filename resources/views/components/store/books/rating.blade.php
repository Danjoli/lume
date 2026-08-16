@props([
    'rating' => 0,
    'count' => 0,
])

<div {{ $attributes->merge([
    'class' => 'flex items-center gap-2'
]) }}>

    <div class="flex text-[#E9A512]">

        @for($i = 1; $i <= 5; $i++)

            @if($rating >= $i)

                <x-heroicon-s-star class="h-4 w-4" />

            @else

                <x-heroicon-o-star class="h-4 w-4" />

            @endif

        @endfor

    </div>

    <span class="text-[11px] text-[#7A817E]">
        ({{ number_format($count, 0, ',', '.') }})
    </span>

</div>
