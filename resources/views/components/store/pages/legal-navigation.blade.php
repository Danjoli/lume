@props(['items'])

<aside class="hidden lg:block">
    <div class="sticky top-8">
        <p class="text-xs font-bold uppercase tracking-[0.12em] text-[#69736F]">Nesta página</p>
        <nav class="mt-5 flex flex-col gap-3 text-sm text-[#69736F]">
            @foreach($items as $anchor => $label)
                <a href="#{{ $anchor }}" class="transition hover:text-[#0D5147]">{{ $label }}</a>
            @endforeach
        </nav>
    </div>
</aside>
