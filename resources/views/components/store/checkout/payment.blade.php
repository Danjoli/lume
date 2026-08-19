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
            4
        </span>

        <div>

            <h2 class="text-lg font-bold text-[#17231F]">
                Forma de pagamento
            </h2>

            <p class="mt-1 text-sm text-[#69736F]">
                Escolha como deseja pagar seu pedido.
            </p>

        </div>

    </div>

    <div class="mt-6 space-y-3">

        {{-- PIX --}}
        <label
            class="
                flex cursor-pointer items-center gap-4
                rounded-xl border border-[#E5E3DE]
                p-4 transition
                hover:border-[#BFCAC6]
                has-[:checked]:border-[#062B25]
                has-[:checked]:bg-[#F7FAF8]
            "
        >

            <input
                type="radio"
                name="payment_method"
                value="pix"
                @checked(old('payment_method') === 'pix')
                class="
                    h-4 w-4
                    border-[#BFC5C2]
                    text-[#062B25]
                    focus:ring-[#062B25]
                "
            >

            <div
                class="
                    flex h-11 w-11 shrink-0
                    items-center justify-center
                    rounded-xl bg-[#EDF0EC]
                    text-[#315249]
                "
            >
                <x-heroicon-o-qr-code class="h-5 w-5" />
            </div>

            <div class="min-w-0 flex-1">

                <div class="flex flex-wrap items-center gap-2">

                    <strong class="text-sm text-[#17231F]">
                        PIX
                    </strong>

                    <span
                        class="
                            rounded-full bg-[#EDF0EC]
                            px-2.5 py-1
                            text-[10px] font-semibold
                            text-[#315249]
                        "
                    >
                        Aprovação rápida
                    </span>

                </div>

                <p class="mt-1 text-xs leading-5 text-[#69736F]">
                    Após finalizar o pedido, será exibido o QR Code
                    e o código PIX para pagamento.
                </p>

            </div>

        </label>

        {{-- Cartão --}}
        <label
            class="
                flex cursor-pointer items-center gap-4
                rounded-xl border border-[#E5E3DE]
                p-4 transition
                hover:border-[#BFCAC6]
                has-[:checked]:border-[#062B25]
                has-[:checked]:bg-[#F7FAF8]
            "
        >

            <input
                type="radio"
                name="payment_method"
                value="card"
                @checked(old('payment_method') === 'card')
                class="
                    h-4 w-4
                    border-[#BFC5C2]
                    text-[#062B25]
                    focus:ring-[#062B25]
                "
            >

            <div
                class="
                    flex h-11 w-11 shrink-0
                    items-center justify-center
                    rounded-xl bg-[#EDF0EC]
                    text-[#315249]
                "
            >
                <x-heroicon-o-credit-card class="h-5 w-5" />
            </div>

            <div class="min-w-0 flex-1">

                <div class="flex flex-wrap items-center gap-2">

                    <strong class="text-sm text-[#17231F]">
                        Cartão de crédito
                    </strong>

                    <span
                        class="
                            rounded-full bg-[#EDF0EC]
                            px-2.5 py-1
                            text-[10px] font-semibold
                            text-[#315249]
                        "
                    >
                        Até 6x sem juros
                    </span>

                </div>

                <p class="mt-1 text-xs leading-5 text-[#69736F]">
                    Os dados do cartão serão informados na etapa
                    de pagamento após a criação do pedido.
                </p>

            </div>

        </label>

        {{-- Boleto --}}
        <label
            class="
                flex cursor-pointer items-center gap-4
                rounded-xl border border-[#E5E3DE]
                p-4 transition
                hover:border-[#BFCAC6]
                has-[:checked]:border-[#062B25]
                has-[:checked]:bg-[#F7FAF8]
            "
        >

            <input
                type="radio"
                name="payment_method"
                value="boleto"
                @checked(old('payment_method') === 'boleto')
                class="
                    h-4 w-4
                    border-[#BFC5C2]
                    text-[#062B25]
                    focus:ring-[#062B25]
                "
            >

            <div
                class="
                    flex h-11 w-11 shrink-0
                    items-center justify-center
                    rounded-xl bg-[#EDF0EC]
                    text-[#315249]
                "
            >
                <x-heroicon-o-document-text class="h-5 w-5" />
            </div>

            <div class="min-w-0 flex-1">

                <strong class="text-sm text-[#17231F]">
                    Boleto bancário
                </strong>

                <p class="mt-1 text-xs leading-5 text-[#69736F]">
                    O boleto será gerado após a confirmação
                    do pedido e deverá ser pago até o vencimento.
                </p>

            </div>

        </label>

    </div>

    @error('payment_method')
        <p class="mt-3 text-xs text-red-600">
            {{ $message }}
        </p>
    @enderror

    <div
        class="
            mt-5 flex items-start gap-3
            rounded-xl bg-[#F7F6F2] p-4
        "
    >

        <x-heroicon-o-shield-check
            class="mt-0.5 h-5 w-5 shrink-0 text-[#315249]"
        />

        <p class="text-xs leading-5 text-[#69736F]">
            O pagamento será processado de forma segura pelo
            provedor responsável pela transação.
        </p>

    </div>

</section>
