@props([
    'title' => null,
])

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $title ? $title . ' | Lume' : 'Lume' }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

</head>

<body class="bg-[#FCFBF8] text-[#101816] antialiased">

    @include('layouts.store._partials.topbar')

    @include('layouts.store._partials.header')

    <main>
        {{ $slot }}
    </main>

    @include('layouts.store._partials.footer')

</body>

</html>
