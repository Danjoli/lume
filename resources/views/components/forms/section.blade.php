@props([
    'title',
    'description' => null,
])

<section
    {{ $attributes->merge([
        'class' => 'space-y-6',
    ]) }}
>

    <div>

        <h2 class="text-lg font-semibold text-slate-900">

            {{ $title }}

        </h2>

        @if($description)

            <p class="mt-1 text-sm text-slate-500">

                {{ $description }}

            </p>

        @endif

    </div>

    <div class="grid gap-6">

        {{ $slot }}

    </div>

</section>
