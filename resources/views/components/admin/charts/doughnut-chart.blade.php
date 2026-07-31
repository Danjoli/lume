@props([
    'id',
    'width' => '100%',
    'height' => 320,
])

<div
    class="relative mx-auto"
    style="width: {{ is_numeric($width) ? $width . 'px' : $width }}; height: {{ is_numeric($height) ? $height . 'px' : $height }};"
>

    <canvas
        id="{{ $id }}"
        class="h-full w-full"
    ></canvas>

</div>

