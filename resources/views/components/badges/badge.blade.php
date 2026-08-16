@props([
    'variant' => 'gray',
    'size' => 'md',
])

@php

$variants = [
    'gray' => 'bg-slate-100 text-slate-600',
    'blue' => 'bg-blue-50 text-blue-600',
    'green' => 'bg-green-50 text-green-600',
    'red' => 'bg-red-50 text-red-600',
    'yellow' => 'bg-amber-50 text-amber-600',
    'indigo' => 'bg-indigo-50 text-indigo-600',
];

$sizes = [
    'sm' => 'px-2 py-0.5 text-[11px]',
    'md' => 'px-2.5 py-1 text-xs',
    'lg' => 'px-3 py-1.5 text-sm',
];

@endphp

<span
    {{ $attributes->merge([
        'class' =>
            'inline-flex items-center justify-center rounded-full font-medium whitespace-nowrap '
            . ($variants[$variant] ?? $variants['gray'])
            . ' '
            . ($sizes[$size] ?? $sizes['md']),
    ]) }}
>

    {{ $slot }}

</span>
