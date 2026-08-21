@once
@php
    $alerts = collect([
        ['type' => 'success', 'message' => session('success') ?: session('status')],
        ['type' => 'error', 'message' => session('error') ?: ($errors->any() ? $errors->first() : null)],
        ['type' => 'warning', 'message' => session('warning')],
        ['type' => 'info', 'message' => session('info')],
    ])->filter(fn ($alert) => filled($alert['message']));
    $styles = [
        'success' => 'border-emerald-200 bg-emerald-50 text-emerald-900',
        'error' => 'border-red-200 bg-red-50 text-red-900',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-900',
        'info' => 'border-blue-200 bg-blue-50 text-blue-900',
    ];
    $titles = ['success' => 'Tudo certo', 'error' => 'Não foi possível concluir', 'warning' => 'Atenção', 'info' => 'Informação'];
@endphp

@if($alerts->isNotEmpty())
    <div class="fixed right-4 top-4 z-[100] flex w-[calc(100%-2rem)] max-w-md flex-col gap-3" aria-live="polite">
        @foreach($alerts as $alert)
            <div data-flash-alert class="flex items-start gap-3 rounded-xl border px-4 py-3 shadow-lg {{ $styles[$alert['type']] }}" role="alert">
                <div class="min-w-0 flex-1"><p class="text-sm font-bold">{{ $titles[$alert['type']] }}</p><p class="mt-0.5 text-sm leading-5">{{ $alert['message'] }}</p></div>
                <button type="button" data-flash-close class="rounded p-1 opacity-60 hover:opacity-100" aria-label="Fechar notificação">✕</button>
            </div>
        @endforeach
    </div>
    <script>document.querySelectorAll('[data-flash-alert]').forEach((alert)=>{const close=()=>{alert.style.opacity='0';alert.style.transform='translateY(-8px)';setTimeout(()=>alert.remove(),200)};alert.style.transition='opacity .2s ease, transform .2s ease';alert.querySelector('[data-flash-close]')?.addEventListener('click',close);setTimeout(close,6000)});</script>
@endif
@endonce
