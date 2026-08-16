@props([
    'id',
    'name',
    'value' => '',
    'rows' => 4,
])

<textarea
    id="{{ $id }}"
    name="{{ $name }}"
    rows="{{ $rows }}"

    {{ $attributes->merge([
        'class' => 'block w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
    ]) }}
>{{ old($name, $value) }}</textarea>
