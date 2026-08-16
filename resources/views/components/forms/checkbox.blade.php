@props([
    'id',
    'name',
    'checked' => false,
])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="checkbox"

    @checked(old($name, $checked))

    {{ $attributes->merge([
        'class' => 'h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500',
    ]) }}
>
