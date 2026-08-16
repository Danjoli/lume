<!DOCTYPE html>
<html lang="pt-BR">

@include('layouts.admin._partials.head')

<body class="min-h-screen bg-gray-100 antialiased">

    <div class="flex min-h-screen items-center justify-center p-6">

        <div class="w-full max-w-md">

            {{-- Logo --}}
            <div class="mb-8 text-center">

                <a
                    href="{{ route('admin.login') }}"
                    class="inline-flex items-center gap-3"
                >

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-xl font-bold text-white shadow"
                    >
                        L
                    </div>

                    <div class="text-left">

                        <h1 class="text-2xl font-bold text-gray-900">
                            Lume
                        </h1>

                        <p class="text-sm text-gray-500">
                            Painel Administrativo
                        </p>

                    </div>

                </a>

            </div>

            {{-- Card --}}
            <div class="rounded-2xl bg-white p-8 shadow-lg">

                {{ $slot }}

            </div>

        </div>

    </div>

    @include('layouts.admin._partials.scripts')

</body>

</html>
