<x-admin.app-layout :title="$coupon->code">

    <div class="space-y-8">

        <x-admin.headers.page-header :title="$coupon->code" description="Detalhes do cupom.">

            <div class="flex gap-3">

                <x-buttons.secondary-button :href="route('admin.coupons.index')">

                    Voltar

                </x-buttons.secondary-button>

                <x-buttons.primary-button :href="route('admin.coupons.edit', $coupon)">

                    Editar

                </x-buttons.primary-button>

            </div>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        <x-admin.cards.details-card>

            <div>

                <dt>Código</dt>

                <dd>{{ $coupon->code }}</dd>

            </div>

            <div>

                <dt>Tipo</dt>

                <dd>

                    {{ $coupon->type === 'percentage' ? 'Percentual' : 'Valor Fixo' }}

                </dd>

            </div>

            <div>

                <dt>Valor</dt>

                <dd>

                    {{ $coupon->type === 'percentage' ? $coupon->value . '%' : 'R$ ' . number_format($coupon->value, 2, ',', '.') }}

                </dd>

            </div>

            <div>

                <dt>Compra mínima</dt>

                <dd>

                    R$ {{ number_format($coupon->minimum_amount, 2, ',', '.') }}

                </dd>

            </div>

            <div>

                <dt>Utilizações</dt>

                <dd>

                    {{ $coupon->used_count }}

                    /

                    {{ $coupon->usage_limit ?: '∞' }}

                </dd>

            </div>

            <div>

                <dt>Status</dt>

                <dd>

                    @if ($coupon->active)
                        <x-badges.badge variant="green">

                            Ativo

                        </x-badges.badge>
                    @else
                        <x-badges.badge variant="red">

                            Inativo

                        </x-badges.badge>
                    @endif

                </dd>

            </div>

            <div>

                <dt>Expira em</dt>

                <dd>

                    {{ optional($coupon->expires_at)->format('d/m/Y') ?: '-' }}

                </dd>

            </div>

            <div>

                <dt>Criado em</dt>

                <dd>

                    {{ $coupon->created_at->format('d/m/Y H:i') }}

                </dd>

            </div>

        </x-admin.cards.details-card>

    </div>

</x-admin.app-layout>
