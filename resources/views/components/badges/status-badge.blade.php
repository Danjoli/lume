@props([
    'status',
    'size' => 'md',
])

@php

$statusValue = match (true) {

    $status instanceof \BackedEnum
        => (string) $status->value,

    $status instanceof \UnitEnum
        => strtolower($status->name),

    default
        => (string) $status,

};

$config = [

    'active' => [
        'label' => 'Ativo',
        'variant' => 'green',
    ],

    'inactive' => [
        'label' => 'Inativo',
        'variant' => 'gray',
    ],

    'pending' => [
        'label' => 'Pendente',
        'variant' => 'yellow',
    ],

    'processing' => [
        'label' => 'Processando',
        'variant' => 'blue',
    ],

    'paid' => [
        'label' => 'Pago',
        'variant' => 'green',
    ],

    'shipped' => [
        'label' => 'Enviado',
        'variant' => 'indigo',
    ],

    'delivered' => [
        'label' => 'Entregue',
        'variant' => 'green',
    ],

    'cancelled' => [
        'label' => 'Cancelado',
        'variant' => 'red',
    ],

    'refunded' => [
        'label' => 'Reembolsado',
        'variant' => 'gray',
    ],

];

$item = $config[$statusValue] ?? [
    'label' => ucfirst(str_replace('_', ' ', $statusValue)),
    'variant' => 'gray',
];

@endphp

<x-badges.badge
    :variant="$item['variant']"
    :size="$size"
>
    {{ $item['label'] }}
</x-badges.badge>
