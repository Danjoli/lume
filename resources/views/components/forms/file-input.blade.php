@props([
    'id',
    'name',
])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="file"

    {{ $attributes->merge([
        'class' => 'block w-full rounded-lg border border-slate-300 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:font-medium file:text-white hover:file:bg-indigo-700',
    ]) }}
>
