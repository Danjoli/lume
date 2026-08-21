@props([
    'name',
    'color' => 'current',
    'size' => 'h-5 w-5',
])

@php

$colors = [
    'current' => '',
    'gray' => 'text-slate-500',
    'slate' => 'text-slate-700',
    'blue' => 'text-blue-600',
    'green' => 'text-green-600',
    'red' => 'text-red-600',
    'yellow' => 'text-amber-500',
    'indigo' => 'text-indigo-600',
    'white' => 'text-white',
];

$class = trim(
    ($colors[$color] ?? '') . ' ' . $size
);

@endphp

@switch($name)

    @case('home')
        <x-heroicon-o-home {{ $attributes->class($class) }} />
        @break

    @case('book')
        <x-heroicon-o-book-open {{ $attributes->class($class) }} />
        @break

    @case('category')
        <x-heroicon-o-tag {{ $attributes->class($class) }} />
        @break

    @case('author')
        <x-heroicon-o-pencil-square {{ $attributes->class($class) }} />
        @break

    @case('publisher')
        <x-heroicon-o-building-office-2 {{ $attributes->class($class) }} />
        @break

    @case('orders')
        <x-heroicon-o-shopping-cart {{ $attributes->class($class) }} />
        @break

    @case('shipments')
        <x-heroicon-o-truck {{ $attributes->class($class) }} />
        @break

    @case('users')
        <x-heroicon-o-users {{ $attributes->class($class) }} />
        @break

    @case('reviews')
        <x-heroicon-o-star {{ $attributes->class($class) }} />
        @break

    @case('coupon')
        <x-heroicon-o-ticket {{ $attributes->class($class) }} />
        @break

    @case('reports')
        <x-heroicon-o-chart-bar {{ $attributes->class($class) }} />
        @break

    @case('settings')
        <x-heroicon-o-cog-6-tooth {{ $attributes->class($class) }} />
        @break

    @case('money')
        <x-heroicon-o-banknotes {{ $attributes->class($class) }} />
        @break

    @case('search')
        <x-heroicon-o-magnifying-glass {{ $attributes->class($class) }} />
        @break

    @case('eye')
        <x-heroicon-o-eye {{ $attributes->class($class) }} />
        @break

    @case('edit')
        <x-heroicon-o-pencil-square {{ $attributes->class($class) }} />
        @break

    @case('trash')
        <x-heroicon-o-trash {{ $attributes->class($class) }} />
        @break

    @case('admins')
        <x-heroicon-o-shield-check {{ $attributes->class($class) }} />
        @break

    @case('contact')
        <x-heroicon-o-chat-bubble-left-right {{ $attributes->class($class) }} />
        @break

    @case('newsletter')
        <x-heroicon-o-envelope {{ $attributes->class($class) }} />
        @break

    @default
        <x-heroicon-o-question-mark-circle {{ $attributes->class($class) }} />

@endswitch
