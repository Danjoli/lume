@props([
    'book',
])

<div>

    @if($book->sale_price)

        <span class="block text-xs text-[#8B918F] line-through">
            R$ {{ number_format($book->price, 2, ',', '.') }}
        </span>

        <strong class="text-base font-bold text-[#16231F]">
            R$ {{ number_format($book->sale_price, 2, ',', '.') }}
        </strong>

    @else

        <strong class="text-base font-bold text-[#16231F]">
            R$ {{ number_format($book->price, 2, ',', '.') }}
        </strong>

    @endif

</div>
