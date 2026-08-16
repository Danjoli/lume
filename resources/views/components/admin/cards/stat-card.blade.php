@props(['title', 'value', 'icon' => null, 'color' => 'indigo', 'change' => null, 'changeType' => 'positive'])

<div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

    <div class="flex items-center gap-6">

        <div
            class="flex h-20 w-20 items-center justify-center rounded-2xl
            {{ match ($color) {
                'blue' => 'bg-blue-100 text-blue-600',
                'green' => 'bg-green-100 text-green-600',
                'red' => 'bg-red-100 text-red-600',
                'yellow' => 'bg-yellow-100 text-yellow-600',
                default => 'bg-indigo-100 text-indigo-600',
            } }}">

            <x-admin.icons.icon :name="$icon" class="h-9 w-9" />

        </div>

        <div>

            <p class="text-sm font-medium text-gray-500">

                {{ $title }}

            </p>

            <h3 class="mt-2 text-3xl font-bold text-gray-900">

                {{ $value }}

            </h3>

            @if ($change !== null)
                <p
                    class="mt-3 text-sm font-medium
                        {{ $changeType === 'positive' ? 'text-green-600' : 'text-red-600' }}">

                    {{ $change > 0 ? '+' : '' }}{{ $change }}

                </p>
            @endif

        </div>

    </div>

</div>
