@props(['label', 'route', 'icon' => null])

@php

    $active = request()->routeIs($route);

@endphp

<a href="{{ route($route) }}"
    class="
        flex items-center gap-3 rounded-lg px-4 py-3
        text-sm font-medium
        transition-all duration-200

        {{ $active ? 'bg-indigo-600 text-white shadow' : 'text-white-600 hover:bg-gray-100 hover:text-gray-900' }}
    ">

    {{-- Ícone --}}
    <span class="h-5 w-5">

        <x-admin.icons.icon :name="$icon" class="h-5 w-5" />

    </span>

    {{-- Texto --}}
    <span>

        {{ $label }}

    </span>

</a>
