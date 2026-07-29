<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Painel Administrativo')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

</head>

<body class="bg-gray-100 text-gray-900">

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

</body>

</html>
