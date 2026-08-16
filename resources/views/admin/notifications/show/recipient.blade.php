<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Destinatário

    </h2>

    <dl class="space-y-4">

        <div>

            <dt>Usuário</dt>

            <dd>{{ $notification->user->name }}</dd>

        </div>

        <div>

            <dt>E-mail</dt>

            <dd>{{ $notification->user->email }}</dd>

        </div>

        <div>

            <dt>Lida em</dt>

            <dd>

                {{ optional($notification->read_at)->format('d/m/Y H:i') ?: '-' }}

            </dd>

        </div>

    </dl>

</x-admin.cards.card>
