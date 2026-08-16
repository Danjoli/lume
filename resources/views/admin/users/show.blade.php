<x-admin.app-layout :title="$user->name">

    <div class="space-y-8">

        <x-admin.headers.page-header :title="$user->name" description="Visualize os dados do usuário.">

            <div class="flex gap-3">

                <x-buttons.secondary-button :href="route('admin.users.index')">

                    Voltar

                </x-buttons.secondary-button>

                <x-buttons.primary-button :href="route('admin.users.edit', $user)">

                    Editar

                </x-buttons.primary-button>

            </div>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        <x-admin.cards.details-card>

            <div>

                <dt class="text-sm font-medium text-slate-500">

                    Nome

                </dt>

                <dd class="mt-1">

                    {{ $user->name }}

                </dd>

            </div>

            <div>

                <dt class="text-sm font-medium text-slate-500">

                    E-mail

                </dt>

                <dd class="mt-1">

                    {{ $user->email }}

                </dd>

            </div>

            <div>

                <dt class="text-sm font-medium text-slate-500">

                    Status

                </dt>

                <dd class="mt-1">

                    <x-badges.status-badge :status="$user->status" />

                </dd>

            </div>

            <div>

                <dt class="text-sm font-medium text-slate-500">

                    E-mail

                </dt>

                <dd class="mt-1">

                    {{ $user->email_verified_at ? 'Verificado' : 'Não verificado' }}

                </dd>

            </div>

            <div>

                <dt class="text-sm font-medium text-slate-500">

                    Criado em

                </dt>

                <dd class="mt-1">

                    {{ $user->created_at->format('d/m/Y H:i') }}

                </dd>

            </div>

            <div>

                <dt class="text-sm font-medium text-slate-500">

                    Atualizado em

                </dt>

                <dd class="mt-1">

                    {{ $user->updated_at->format('d/m/Y H:i') }}

                </dd>

            </div>

        </x-admin.cards.details-card>

    </div>

</x-admin.app-layout>
