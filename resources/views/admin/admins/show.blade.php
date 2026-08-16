<x-admin.app-layout title="Administrador">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Administrador" description="Detalhes do administrador.">

            <div class="flex gap-3">

                <x-buttons.secondary-button :href="route('admin.admins.index')">
                    Voltar
                </x-buttons.secondary-button>

                <x-buttons.primary-button :href="route('admin.admins.edit', $admin)">
                    Editar
                </x-buttons.primary-button>

            </div>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-slate-100">

                        <span class="text-xl font-semibold text-slate-600">
                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                        </span>

                    </div>

                    <div>

                        <h2 class="text-lg font-semibold text-slate-900">
                            {{ $admin->name }}
                        </h2>

                        <p class="text-sm text-slate-500">
                            Administrador #{{ $admin->id }}
                        </p>

                    </div>

                </div>

            </div>

            <div class="grid gap-6 p-6 md:grid-cols-2">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Nome
                    </p>

                    <p class="mt-1 text-sm text-slate-900">
                        {{ $admin->name }}
                    </p>

                </div>

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        E-mail
                    </p>

                    <p class="mt-1 text-sm text-slate-900">
                        {{ $admin->email }}
                    </p>

                </div>

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Cadastrado em
                    </p>

                    <p class="mt-1 text-sm text-slate-900">
                        {{ $admin->created_at?->format('d/m/Y H:i') }}
                    </p>

                </div>

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Última atualização
                    </p>

                    <p class="mt-1 text-sm text-slate-900">
                        {{ $admin->updated_at?->format('d/m/Y H:i') }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</x-admin.app-layout>
