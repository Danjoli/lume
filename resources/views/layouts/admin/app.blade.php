<!DOCTYPE html>
<html lang="pt-BR">

@include('layouts.admin._partials.head')

<body
    x-data="{ sidebarOpen: true }"
    class="bg-gray-100 antialiased"
>
    <x-alerts.flash />

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        @include('layouts.admin._partials.sidebar')

        {{-- Conteúdo --}}
        <div class="flex min-w-0 flex-1 flex-col overflow-hidden">

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
