<x-store.app-layout title="Minha conta">

    <section class="py-10 lg:py-14">

        <x-store.ui.container>

            <div class="mx-auto max-w-5xl">

                <div class="mb-8">

                    <span
                        class="
                            inline-flex rounded-full
                            bg-[#EDF0EC] px-4 py-1.5
                            text-xs font-semibold text-[#233A35]
                        "
                    >
                        Minha conta
                    </span>

                    <h1
                        class="
                            mt-5 text-3xl font-bold
                            tracking-[-0.03em]
                            text-[#10211E]
                            lg:text-4xl
                        "
                    >
                        Olá, {{ $user->name }}
                    </h1>

                    <p class="mt-2 text-sm text-[#69736F]">
                        Gerencie seus dados, pedidos, endereços e segurança da conta.
                    </p>

                </div>

                <x-alerts.flash />

                <div
                    class="
                        grid gap-6
                        lg:grid-cols-[minmax(0,1fr)_320px]
                    "
                >

                    <div class="space-y-6">

                        {{-- Dados pessoais --}}
                        <section
                            class="
                                rounded-2xl border border-[#E5E3DE]
                                bg-white p-6
                            "
                        >

                            <div class="flex items-start justify-between gap-4">

                                <div>

                                    <h2 class="text-lg font-bold text-[#17231F]">
                                        Dados pessoais
                                    </h2>

                                    <p class="mt-1 text-sm text-[#69736F]">
                                        Consulte e atualize as informações da sua conta.
                                    </p>

                                </div>

                                <a
                                    href="{{ route('store.customer.profile.edit') }}"
                                    class="
                                        text-sm font-semibold
                                        text-[#315249]
                                        transition
                                        hover:text-[#062B25]
                                    "
                                >
                                    Editar
                                </a>

                            </div>

                            <div
                                class="
                                    mt-6 grid gap-5
                                    border-t border-[#ECEAE6]
                                    pt-6 sm:grid-cols-2
                                "
                            >

                                <div>

                                    <p class="text-xs text-[#8A918E]">
                                        Nome
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-[#17231F]">
                                        {{ $user->name }}
                                    </p>

                                </div>

                                <div>

                                    <p class="text-xs text-[#8A918E]">
                                        E-mail
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-[#17231F]">
                                        {{ $user->email }}
                                    </p>

                                </div>

                                @if($user->phone)

                                    <div>

                                        <p class="text-xs text-[#8A918E]">
                                            Telefone
                                        </p>

                                        <p class="mt-1 text-sm font-medium text-[#17231F]">
                                            {{ $user->phone }}
                                        </p>

                                    </div>

                                @endif

                            </div>

                        </section>

                        {{-- Acessos rápidos --}}
                        <section>

                            <h2 class="text-lg font-bold text-[#17231F]">
                                Acessos rápidos
                            </h2>

                            <div class="mt-4 grid gap-4 sm:grid-cols-2">

                                <a
                                    href="{{ route('store.customer.orders.index') }}"
                                    class="
                                        group rounded-2xl
                                        border border-[#E5E3DE]
                                        bg-white p-5 transition
                                        hover:border-[#BFCAC6]
                                        hover:shadow-sm
                                    "
                                >

                                    <div
                                        class="
                                            flex h-11 w-11
                                            items-center justify-center
                                            rounded-xl bg-[#EDF0EC]
                                            text-[#315249]
                                        "
                                    >
                                        <x-heroicon-o-shopping-bag class="h-5 w-5" />
                                    </div>

                                    <h3
                                        class="
                                            mt-4 font-semibold
                                            text-[#17231F]
                                            transition
                                            group-hover:text-[#0D5147]
                                        "
                                    >
                                        Meus pedidos
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        Consulte suas compras e acompanhe seus pedidos.
                                    </p>

                                </a>

                                <a
                                    href="{{ route('store.customer.addresses.index') }}"
                                    class="
                                        group rounded-2xl
                                        border border-[#E5E3DE]
                                        bg-white p-5 transition
                                        hover:border-[#BFCAC6]
                                        hover:shadow-sm
                                    "
                                >

                                    <div
                                        class="
                                            flex h-11 w-11
                                            items-center justify-center
                                            rounded-xl bg-[#EDF0EC]
                                            text-[#315249]
                                        "
                                    >
                                        <x-heroicon-o-map-pin class="h-5 w-5" />
                                    </div>

                                    <h3
                                        class="
                                            mt-4 font-semibold
                                            text-[#17231F]
                                            transition
                                            group-hover:text-[#0D5147]
                                        "
                                    >
                                        Meus endereços
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        Gerencie seus endereços de entrega.
                                    </p>

                                </a>

                                <a
                                    href="{{ route('store.wishlist.index') }}"
                                    class="
                                        group rounded-2xl
                                        border border-[#E5E3DE]
                                        bg-white p-5 transition
                                        hover:border-[#BFCAC6]
                                        hover:shadow-sm
                                    "
                                >

                                    <div
                                        class="
                                            flex h-11 w-11
                                            items-center justify-center
                                            rounded-xl bg-[#EDF0EC]
                                            text-[#315249]
                                        "
                                    >
                                        <x-heroicon-o-heart class="h-5 w-5" />
                                    </div>

                                    <h3
                                        class="
                                            mt-4 font-semibold
                                            text-[#17231F]
                                            transition
                                            group-hover:text-[#0D5147]
                                        "
                                    >
                                        Lista de desejos
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        Veja os livros que você salvou para depois.
                                    </p>

                                </a>

                                <a
                                    href="{{ route('store.customer.security.edit') }}"
                                    class="
                                        group rounded-2xl
                                        border border-[#E5E3DE]
                                        bg-white p-5 transition
                                        hover:border-[#BFCAC6]
                                        hover:shadow-sm
                                    "
                                >

                                    <div
                                        class="
                                            flex h-11 w-11
                                            items-center justify-center
                                            rounded-xl bg-[#EDF0EC]
                                            text-[#315249]
                                        "
                                    >
                                        <x-heroicon-o-lock-closed class="h-5 w-5" />
                                    </div>

                                    <h3
                                        class="
                                            mt-4 font-semibold
                                            text-[#17231F]
                                            transition
                                            group-hover:text-[#0D5147]
                                        "
                                    >
                                        Segurança
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-[#69736F]">
                                        Altere sua senha e proteja sua conta.
                                    </p>

                                </a>

                            </div>

                        </section>

                    </div>

                    {{-- Menu lateral --}}
                    <aside
                        class="
                            h-fit rounded-2xl
                            bg-[#F2F3EF] p-6
                        "
                    >

                        <div
                            class="
                                flex h-14 w-14
                                items-center justify-center
                                rounded-full bg-white
                                text-[#315249]
                            "
                        >
                            <x-heroicon-o-user class="h-7 w-7" />
                        </div>

                        <h2 class="mt-5 text-lg font-bold text-[#17231F]">
                            {{ $user->name }}
                        </h2>

                        <p class="mt-1 truncate text-sm text-[#69736F]">
                            {{ $user->email }}
                        </p>

                        <div class="my-6 border-t border-[#DCDDD8]"></div>

                        <nav class="space-y-2">

                            <a
                                href="{{ route('store.customer.profile.edit') }}"
                                class="
                                    flex items-center gap-3
                                    rounded-lg px-3 py-2.5
                                    text-sm text-[#394844]
                                    transition hover:bg-white
                                "
                            >
                                <x-heroicon-o-user-circle class="h-5 w-5" />

                                Dados pessoais
                            </a>

                            <a
                                href="{{ route('store.customer.orders.index') }}"
                                class="
                                    flex items-center gap-3
                                    rounded-lg px-3 py-2.5
                                    text-sm text-[#394844]
                                    transition hover:bg-white
                                "
                            >
                                <x-heroicon-o-shopping-bag class="h-5 w-5" />

                                Meus pedidos
                            </a>

                            <a
                                href="{{ route('store.customer.addresses.index') }}"
                                class="
                                    flex items-center gap-3
                                    rounded-lg px-3 py-2.5
                                    text-sm text-[#394844]
                                    transition hover:bg-white
                                "
                            >
                                <x-heroicon-o-map-pin class="h-5 w-5" />

                                Endereços
                            </a>

                            <a
                                href="{{ route('store.customer.security.edit') }}"
                                class="
                                    flex items-center gap-3
                                    rounded-lg px-3 py-2.5
                                    text-sm text-[#394844]
                                    transition hover:bg-white
                                "
                            >
                                <x-heroicon-o-lock-closed class="h-5 w-5" />

                                Segurança
                            </a>

                            <a
                                href="{{ route('store.customer.account.delete') }}"
                                class="
                                    flex items-center gap-3
                                    rounded-lg px-3 py-2.5
                                    text-sm text-[#8A4B4B]
                                    transition
                                    hover:bg-red-50
                                    hover:text-red-600
                                "
                            >
                                <x-heroicon-o-trash class="h-5 w-5" />

                                Excluir conta
                            </a>

                        </nav>

                    </aside>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
