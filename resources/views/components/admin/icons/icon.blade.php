@props([
    'name',
])

@switch($name)

    @case('home')
        <x-heroicon-o-home {{ $attributes }} />
        @break

    @case('book')
        <x-heroicon-o-book-open {{ $attributes }} />
        @break

    @case('category')
        <x-heroicon-o-tag {{ $attributes }} />
        @break

    @case('author')
        <x-heroicon-o-pencil-square {{ $attributes }} />
        @break

    @case('publisher')
        <x-heroicon-o-building-office-2 {{ $attributes }} />
        @break

    @case('orders')
        <x-heroicon-o-shopping-cart {{ $attributes }} />
        @break

    @case('users')
        <x-heroicon-o-users {{ $attributes }} />
        @break

    @case('reviews')
        <x-heroicon-o-star {{ $attributes }} />
        @break

    @case('coupon')
        <x-heroicon-o-ticket {{ $attributes }} />
        @break

    @case('reports')
        <x-heroicon-o-chart-bar {{ $attributes }} />
        @break

    @case('settings')
        <x-heroicon-o-cog-6-tooth {{ $attributes }} />
        @break

    @case('money')
        <x-heroicon-o-banknotes {{ $attributes }} />
        @break

    @default
        <x-heroicon-o-question-mark-circle {{ $attributes }} />

@endswitch
