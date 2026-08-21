@props(['title', 'description', 'href', 'label'])

<section class="border-t border-[#ECEAE6] bg-[#F7F6F2] py-14">
    <x-store.ui.container>
        <div class="mx-auto max-w-3xl text-center">
            <h2 class="text-2xl font-bold text-[#17231F]">{{ $title }}</h2>
            <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-[#69736F]">{{ $description }}</p>
            <a href="{{ $href }}" class="mt-6 inline-flex h-11 items-center justify-center rounded-lg bg-[#062B25] px-6 text-sm font-semibold text-white transition hover:bg-[#0B3C34]">{{ $label }}</a>
        </div>
    </x-store.ui.container>
</section>
