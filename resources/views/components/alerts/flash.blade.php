@if(session('success'))

    <div class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

        {{ session('success') }}

    </div>

@endif

@if(session('error'))

    <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">

        {{ session('error') }}

    </div>

@endif

@if(session('warning'))

    <div class="rounded-xl border border-yellow-200 bg-yellow-50 px-5 py-4 text-yellow-700">

        {{ session('warning') }}

    </div>

@endif

@if(session('info'))

    <div class="rounded-xl border border-blue-200 bg-blue-50 px-5 py-4 text-blue-700">

        {{ session('info') }}

    </div>

@endif
