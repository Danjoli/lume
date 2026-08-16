@props([
    'id',
    'name',
    'type' => 'text',
    'value' => '',
])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="{{ $type }}"
    value="{{ old($name, $value) }}"

    {{ $attributes->merge([
        'class' => 'block w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
    ]) }}
>
