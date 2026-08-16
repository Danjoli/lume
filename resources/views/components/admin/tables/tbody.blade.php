<tbody
    {{ $attributes->merge([
        'class' => 'divide-y divide-slate-200 bg-white',
    ]) }}
>

    {{ $slot }}

</tbody>
