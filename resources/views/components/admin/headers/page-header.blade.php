@props([
    'title',
    'description' => null,
])

<div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">

    <div>

        <h1 class="text-3xl font-bold text-slate-900">

            {{ $title }}

        </h1>

        @if ($description)

            <p class="mt-1 text-sm text-slate-500">

                {{ $description }}

            </p>

        @endif

    </div>

    @if (trim($slot))

        <div class="flex items-center gap-2">

            {{ $slot }}

        </div>

    @endif

</div>
