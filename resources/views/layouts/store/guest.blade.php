<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <meta name="theme-color" content="#062B25">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F6F5F1] text-[#17231F]">
    <x-alerts.flash />
    <main class="flex min-h-screen items-center justify-center p-6">
        <div class="w-full max-w-md">
            <a href="{{ route('store.home') }}" class="mb-8 block text-center text-3xl font-bold">Lume</a>
            <div class="rounded-2xl border border-[#E5E3DE] bg-white p-7 shadow-sm">{{ $slot }}</div>
        </div>
    </main>
</body>
</html>
