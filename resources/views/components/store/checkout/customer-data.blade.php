<section
    class="
        rounded-2xl border border-[#E5E3DE]
        bg-white p-6
    "
>

    <div class="flex items-center gap-3">

        <span
            class="
                flex h-8 w-8 items-center justify-center
                rounded-full bg-[#062B25]
                text-sm font-bold text-white
            "
        >
            2
        </span>

        <div>

            <h2 class="text-lg font-bold text-[#17231F]">
                Dados do pedido
            </h2>

            <p class="mt-1 text-sm text-[#69736F]">
                Confirme seus dados para continuar com a compra.
            </p>

        </div>

    </div>

    <div class="mt-6 grid gap-5 sm:grid-cols-2">

        {{-- CPF --}}
        <div>

            <label
                for="cpf"
                class="
                    mb-2 block text-sm font-semibold
                    text-[#17231F]
                "
            >
                CPF
            </label>

            <input
                id="cpf"
                type="text"
                name="cpf"
                value="{{ old('cpf') }}"
                placeholder="000.000.000-00"
                autocomplete="off"
                class="
                    h-11 w-full rounded-lg
                    border border-[#DDDCD7]
                    bg-white px-4 text-sm
                    text-[#17231F]
                    outline-none transition
                    placeholder:text-[#A0A5A2]
                    focus:border-[#0D5147]
                "
            >

            @error('cpf')
                <p class="mt-2 text-xs text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- Telefone --}}
        <div>

            <label
                for="phone"
                class="
                    mb-2 block text-sm font-semibold
                    text-[#17231F]
                "
            >
                Telefone
            </label>

            <input
                id="phone"
                type="text"
                name="phone"
                value="{{ old('phone', auth()->user()->phone) }}"
                placeholder="(11) 99999-9999"
                autocomplete="tel"
                class="
                    h-11 w-full rounded-lg
                    border border-[#DDDCD7]
                    bg-white px-4 text-sm
                    text-[#17231F]
                    outline-none transition
                    placeholder:text-[#A0A5A2]
                    focus:border-[#0D5147]
                "
            >

            @error('phone')
                <p class="mt-2 text-xs text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

    </div>

    <div
        class="
            mt-5 flex items-start gap-3
            rounded-xl bg-[#F7F6F2] p-4
        "
    >

        <x-heroicon-o-information-circle
            class="mt-0.5 h-5 w-5 shrink-0 text-[#315249]"
        />

        <p class="text-xs leading-5 text-[#69736F]">
            O CPF pode ser utilizado na identificação do pagamento e na emissão
            dos dados relacionados ao pedido. O telefone será usado caso seja
            necessário entrar em contato sobre a compra ou entrega.
        </p>

    </div>

</section>
