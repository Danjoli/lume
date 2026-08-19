{{-- Conta --}}
@if(Auth::check())

    <div
        x-data="{ open: false }"
        class="relative hidden md:block"
    >
        <button
            type="button"
            @click="open = !open"
            @click.outside="open = false"
            class="
                flex items-center gap-2
                text-sm font-medium
                transition hover:text-[#0D5147]
            "
        >
            <x-heroicon-o-user class="h-6 w-6" />

            <span>
                {{ Auth::user()->name }}
            </span>

            <x-heroicon-o-chevron-down class="h-4 w-4" />
        </button>

        <div
            x-show="open"
            x-cloak
            x-transition
            class="
                absolute right-0 top-full z-50 mt-4
                w-56 overflow-hidden
                rounded-xl border border-[#E5E3DE]
                bg-white py-2 shadow-lg
            "
        >
            <a
                href="{{ route('store.customer.profile.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3 text-sm
                    text-[#17231F]
                    transition hover:bg-[#F7F6F2]
                "
            >
                <x-heroicon-o-user-circle class="h-5 w-5" />

                Minha conta
            </a>

            <a
                href="{{ route('store.customer.orders.index') }}"
                class="
                    flex items-center gap-3
                    px-4 py-3 text-sm
                    text-[#17231F]
                    transition hover:bg-[#F7F6F2]
                "
            >
                <x-heroicon-o-shopping-bag class="h-5 w-5" />

                Meus pedidos
            </a>

            <a
                href="{{ route("store.wishlist.index") }}"
                class="
                    flex items-center gap-3
                    px-4 py-3 text-sm
                    text-[#17231F]
                    transition hover:bg-[#F7F6F2]
                "
            >
                <x-heroicon-o-heart class="h-5 w-5" />

                Lista de desejos
            </a>

            <div class="my-2 border-t border-[#ECEAE6]"></div>

            <form
                action="{{ route('logout') }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="
                        flex w-full items-center gap-3
                        px-4 py-3 text-left text-sm
                        text-[#69736F]
                        transition
                        hover:bg-red-50
                        hover:text-red-600
                    "
                >
                    <x-heroicon-o-arrow-right-on-rectangle class="h-5 w-5" />

                    Sair
                </button>
            </form>
        </div>
    </div>

@else

    <a
        href="{{ route('login') }}"
        class="
            hidden items-center gap-2
            text-sm font-medium
            transition hover:text-[#0D5147]
            md:flex
        "
    >
        <x-heroicon-o-user class="h-6 w-6" />

        Entrar
    </a>

@endif
