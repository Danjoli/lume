@props(['action', 'method' => 'POST'])

<form method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST' }}" action="{{ $action }}" {{ $attributes }}>

    @unless (strtoupper($method) === 'GET')
        @csrf
    @endunless

    @if (!in_array(strtoupper($method), ['GET', 'POST']))
        @method($method)
    @endif

    <x-admin.cards.card>

        {{ $slot }}

    </x-admin.cards.card>

</form>
