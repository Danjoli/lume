<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

    <form action="{{ route('admin.admins.index') }}" method="GET">

        <div class="flex flex-col gap-4 lg:flex-row lg:items-end">

            <div class="flex-1">

                <x-forms.label for="search">
                    Pesquisar
                </x-forms.label>

                <x-forms.search id="search" name="search" placeholder="Nome ou e-mail..." />

            </div>

            <div class="flex gap-3">

                <x-buttons.primary-button type="submit">
                    <x-admin.icons.icon name="search" color="white" />

                    Pesquisar
                </x-buttons.primary-button>

                <x-buttons.secondary-button :href="route('admin.admins.index')">
                    Limpar
                </x-buttons.secondary-button>

            </div>

        </div>

    </form>

</div>
