@props([
    'title' => null,
    'subtitle' => null,
])

<div
    {{ $attributes->merge([
        'class' => 'flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm'
    ]) }}
>

    @if($title || $subtitle)

        <div class="px-6 py-5">

            @if($title)
                <h2 class="text-base font-semibold tracking-tight text-slate-900">
                    {{ $title }}
                </h2>
            @endif

            @if($subtitle)
                <p class="mt-1 text-sm text-slate-500">
                    {{ $subtitle }}
                </p>
            @endif

        </div>

        <div class="border-t border-slate-100"></div>

    @endif

    <div class="flex flex-1 flex-col p-6">

        {{ $slot }}

    </div>

</div>
