@props([
    'id',
    'name',
    'checked' => false,
])

<label class="inline-flex cursor-pointer items-center">

    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="checkbox"
        class="peer sr-only"

        @checked(old($name, $checked))
    >

    <div class="peer relative h-6 w-11 rounded-full bg-gray-300 transition peer-checked:bg-indigo-600 after:absolute after:left-1 after:top-1 after:h-4 after:w-4 after:rounded-full after:bg-white after:transition-all peer-checked:after:translate-x-5"></div>

    @if(trim($slot))

        <span class="ml-3 text-sm text-slate-700">

            {{ $slot }}

        </span>

    @endif

</label>
