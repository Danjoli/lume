<x-admin.cards.card>

    <h2 class="mb-6 text-lg font-semibold">

        Cliente

    </h2>

    <dl class="space-y-5">

        <div>

            <dt>Nome</dt>

            <dd>

                {{ $review->user->name }}

            </dd>

        </div>

        <div>

            <dt>E-mail</dt>

            <dd>

                {{ $review->user->email }}

            </dd>

        </div>

        <div>

            <dt>Total de Pedidos</dt>

            <dd>

                {{ $review->user->orders_count }}

            </dd>

        </div>

        <div>

            <dt>Total de Avaliações</dt>

            <dd>

                {{ $review->user->reviews_count }}

            </dd>

        </div>

    </dl>

</x-admin.cards.card>
