<head>

    @include('layouts.admin._partials.meta')

    <title>
        @hasSection('title')
            @yield('title') • Lume Admin
        @else
            Painel Administrativo • Lume
        @endif
    </title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- CSS e JS do Laravel --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

    {{-- CSS específico de uma página --}}
    @stack('styles')

</head>
