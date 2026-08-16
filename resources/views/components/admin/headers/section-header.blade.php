@props([
    'title',
    'description' => null,
])

<div class="mb-4">

    <h2 class="text-xl font-semibold text-slate-900">

        {{ $title }}

    </h2>

    @if ($description)

        <p class="mt-1 text-sm text-slate-500">

            {{ $description }}

        </p>

    @endif

</div>
