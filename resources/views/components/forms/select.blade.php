@props([
    'id',
    'name',
])

<select

    id="{{ $id }}"

    name="{{ $name }}"

    {{ $attributes->merge([
        'class' => 'block w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
    ]) }}

>

    {{ $slot }}

</select>
