<x-admin.cards.card>

    <dl {{ $attributes->merge([
        'class' => 'grid grid-cols-1 gap-6 md:grid-cols-2',
    ]) }}>

        {{ $slot }}

    </dl>

</x-admin.cards.card>
