<!DOCTYPE html>
<html lang="pt-BR">

@include('layouts.admin.head')

<body class="bg-gray-100 antialiased">

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        <x-admin.layout.sidebar />

        {{-- Conteúdo --}}
        <div class="flex flex-1 flex-col overflow-hidden">

            {{-- Header --}}
            <x-admin.layout.header />

            {{-- Conteúdo Principal --}}
            <main class="flex-1 overflow-y-auto p-8">

                {{ $slot }}

            </main>

        </div>

    </div>

    @include('layouts.admin.scripts')

</body>

</html>
