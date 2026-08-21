<x-admin.cards.card>
    <div class="flex flex-col justify-between gap-5 md:flex-row md:items-center">
        <div>
            <h2 class="text-lg font-semibold">Integração com o Melhor Envio</h2>
            <p class="mt-1 text-sm text-slate-500">
                Ambiente: {{ ucfirst(config('services.melhor_envio.environment')) }}.
                O acesso é renovado automaticamente pelo OAuth2.
            </p>

            @if ($melhorEnvioConnection)
                <p class="mt-3 text-sm font-medium text-emerald-700">
                    Conectado • token válido até {{ $melhorEnvioConnection->expires_at?->format('d/m/Y H:i') ?: 'data não informada' }}
                </p>
            @else
                <p class="mt-3 text-sm font-medium text-amber-700">Conta ainda não conectada.</p>
            @endif
        </div>

        @if ($melhorEnvioConnection)
            <form method="POST" action="{{ route('admin.settings.melhor-envio.disconnect') }}" onsubmit="return confirm('Deseja desconectar a conta do Melhor Envio?')">
                @csrf
                @method('DELETE')
                <button class="rounded-lg border border-red-300 px-4 py-2 text-sm font-semibold text-red-700">Desconectar</button>
            </form>
        @else
            <a href="{{ route('admin.settings.melhor-envio.connect') }}" class="inline-flex rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">
                Conectar Melhor Envio
            </a>
        @endif
    </div>
</x-admin.cards.card>
