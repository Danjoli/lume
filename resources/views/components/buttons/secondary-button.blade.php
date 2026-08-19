@props([
    'href' => null,
])

@php
    $classes = '
        inline-flex items-center justify-center
        rounded-lg border border-slate-300
        bg-white px-4 py-2
        text-sm font-medium text-slate-700
        transition
        hover:bg-slate-50
        focus:outline-none
        focus:ring-2
        focus:ring-slate-300
        disabled:cursor-not-allowed
        disabled:opacity-50
    ';
@endphp

@if($href)

    <a
        href="{{ $href }}"
        {{ $attributes->except('href')->merge([
            'class' => $classes,
        ]) }}
    >
        {{ $slot }}
    </a>

@else

    <button
        {{ $attributes->merge([
            'type' => 'button',
            'class' => $classes,
        ]) }}
    >
        {{ $slot }}
    </button>

@endif
