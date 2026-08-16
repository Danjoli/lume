<a
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-medium text-indigo-600 transition hover:bg-indigo-50 hover:text-indigo-700',
    ]) }}
>
    {{ $slot }}
</a>
