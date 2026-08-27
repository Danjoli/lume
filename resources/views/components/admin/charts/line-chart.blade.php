@props([
    'id',
    'height' => 320,
    'chart' => null,
    'labels' => [],
    'values' => [],
])

<div class="rounded-xl border border-slate-100 bg-white p-5">

    <div
        class="relative"
        style="height: {{ $height }}px;"
    >
        <canvas
            id="{{ $id }}"
            @if ($chart)
                data-admin-chart="{{ $chart }}"
                data-chart-labels="{{ json_encode($labels) }}"
                data-chart-values="{{ json_encode($values) }}"
            @endif
        ></canvas>
    </div>

</div>
