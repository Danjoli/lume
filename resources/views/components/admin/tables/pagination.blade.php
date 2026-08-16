@props([
    'paginator',
])

@if ($paginator->hasPages())

    <div class="mt-6">

        {{ $paginator->links() }}

    </div>

@endif
