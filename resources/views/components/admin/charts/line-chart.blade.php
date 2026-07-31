@props([
    'id',
    'height' => 320,
])

<div class="rounded-xl border border-slate-100 bg-white p-5">

    <div
        class="relative"
        style="height: {{ $height }}px;"
    >
        <canvas id="{{ $id }}"></canvas>
    </div>

</div>
