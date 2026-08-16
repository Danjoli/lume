@props([
    'name' => 'search',
    'placeholder' => 'Pesquisar...',
])

<div class="relative">

    <input type="search" name="{{ $name }}" value="{{ request($name) }}" placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full rounded-lg border-slate-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
        ]) }}>

    <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">

        <x-admin.icons.icon name="search" class="h-5 w-5" />

    </div>

</div>
