@props(['eyebrow', 'title', 'description', 'updatedAt' => null])

<section class="border-b border-[#ECEAE6] py-14 lg:py-16">
    <x-store.ui.container>
        <div class="mx-auto max-w-5xl">
            <span class="inline-flex rounded-full bg-[#EDF0EC] px-4 py-1.5 text-xs font-semibold text-[#233A35]">{{ $eyebrow }}</span>
            <h1 class="mt-5 text-4xl font-bold tracking-[-0.035em] text-[#10211E] lg:text-5xl">{{ $title }}</h1>
            <p class="mt-4 max-w-2xl text-base leading-7 text-[#64706D]">{{ $description }}</p>
            @if($updatedAt)<p class="mt-4 text-xs text-[#8A918E]">Última atualização: {{ $updatedAt }}</p>@endif
        </div>
    </x-store.ui.container>
</section>
