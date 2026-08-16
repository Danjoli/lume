<!DOCTYPE html>
<html lang="pt-BR">

@include('layouts.admin._partials.head')

<body class="bg-gray-100 antialiased">

    <div class="flex h-screen overflow-hidden">

        {{-- navigation.sidebar --}}
        @include('layouts.admin._partials.sidebar')

        {{-- Conteúdo --}}
        <div class="flex flex-1 flex-col overflow-hidden">

            {{-- Header --}}
            @include('layouts.admin._partials.header')

            {{-- Conteúdo Principal --}}
            <main class="flex-1 overflow-y-auto p-8">

                {{ $slot }}

            </main>

        </div>

    </div>

    @include('layouts.admin._partials.scripts')

</body>

</html>
