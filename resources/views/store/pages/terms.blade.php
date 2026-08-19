<x-store.app-layout title="Termos de Uso">

    {{-- Cabeçalho --}}
    <section class="border-b border-[#ECEAE6] py-14 lg:py-16">

        <x-store.ui.container>

            <div class="mx-auto max-w-5xl">

                <span
                    class="
                        inline-flex rounded-full
                        bg-[#EDF0EC] px-4 py-1.5
                        text-xs font-semibold text-[#233A35]
                    "
                >
                    Institucional
                </span>

                <h1
                    class="
                        mt-5 text-4xl font-bold
                        tracking-[-0.035em] text-[#10211E]
                        lg:text-5xl
                    "
                >
                    Termos de Uso
                </h1>

                <p
                    class="
                        mt-4 max-w-2xl
                        text-base leading-7 text-[#64706D]
                    "
                >
                    Consulte as regras e condições gerais para utilização
                    da plataforma e dos serviços oferecidos pela Lume.
                </p>

                <p class="mt-4 text-xs text-[#8A918E]">
                    Última atualização: agosto de 2026
                </p>

            </div>

        </x-store.ui.container>

    </section>

    {{-- Conteúdo --}}
    <section class="py-14 lg:py-20">

        <x-store.ui.container>

            <div
                class="
                    mx-auto grid max-w-5xl gap-12
                    lg:grid-cols-[220px_minmax(0,1fr)]
                "
            >

                {{-- Índice --}}
                <aside class="hidden lg:block">

                    <div class="sticky top-8">

                        <p
                            class="
                                text-xs font-bold uppercase
                                tracking-[0.12em] text-[#69736F]
                            "
                        >
                            Nesta página
                        </p>

                        <nav
                            class="
                                mt-5 flex flex-col gap-3
                                text-sm text-[#69736F]
                            "
                        >

                            <a
                                href="#aceitacao"
                                class="transition hover:text-[#0D5147]"
                            >
                                Aceitação dos termos
                            </a>

                            <a
                                href="#cadastro"
                                class="transition hover:text-[#0D5147]"
                            >
                                Cadastro
                            </a>

                            <a
                                href="#compras"
                                class="transition hover:text-[#0D5147]"
                            >
                                Compras
                            </a>

                            <a
                                href="#precos"
                                class="transition hover:text-[#0D5147]"
                            >
                                Preços e disponibilidade
                            </a>

                            <a
                                href="#pagamentos"
                                class="transition hover:text-[#0D5147]"
                            >
                                Pagamentos
                            </a>

                            <a
                                href="#entregas"
                                class="transition hover:text-[#0D5147]"
                            >
                                Entregas
                            </a>

                            <a
                                href="#trocas"
                                class="transition hover:text-[#0D5147]"
                            >
                                Trocas e devoluções
                            </a>

                            <a
                                href="#uso-plataforma"
                                class="transition hover:text-[#0D5147]"
                            >
                                Uso da plataforma
                            </a>

                            <a
                                href="#responsabilidades"
                                class="transition hover:text-[#0D5147]"
                            >
                                Responsabilidades
                            </a>

                            <a
                                href="#alteracoes"
                                class="transition hover:text-[#0D5147]"
                            >
                                Alterações
                            </a>

                            <a
                                href="#contato"
                                class="transition hover:text-[#0D5147]"
                            >
                                Contato
                            </a>

                        </nav>

                    </div>

                </aside>

                {{-- Termos --}}
                <div class="min-w-0">

                    <div
                        class="
                            rounded-2xl border border-[#E5E3DE]
                            bg-white p-6
                            sm:p-8 lg:p-10
                        "
                    >

                        <div
                            class="
                                space-y-10
                                text-sm leading-7 text-[#64706D]
                            "
                        >

                            <section id="aceitacao">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    1. Aceitação dos termos
                                </h2>

                                <p class="mt-4">
                                    Estes Termos de Uso apresentam as condições
                                    gerais aplicáveis ao acesso e utilização
                                    da plataforma da Lume.
                                </p>

                                <p class="mt-3">
                                    Ao utilizar a plataforma, criar uma conta
                                    ou realizar uma compra, o usuário declara
                                    estar de acordo com as condições aplicáveis
                                    ao serviço utilizado.
                                </p>

                            </section>

                            <section id="cadastro">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    2. Cadastro e conta
                                </h2>

                                <p class="mt-4">
                                    Algumas funcionalidades podem exigir a criação
                                    de uma conta. O usuário é responsável por
                                    fornecer informações corretas e mantê-las
                                    atualizadas.
                                </p>

                                <p class="mt-3">
                                    Os dados de acesso são pessoais e não devem
                                    ser compartilhados com terceiros.
                                </p>

                            </section>

                            <section id="compras">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    3. Compras e pedidos
                                </h2>

                                <p class="mt-4">
                                    Antes da conclusão da compra, o usuário
                                    poderá revisar os produtos selecionados,
                                    quantidades, endereço de entrega e demais
                                    informações apresentadas no checkout.
                                </p>

                                <p class="mt-3">
                                    A conclusão do pedido pode estar sujeita
                                    à confirmação do pagamento e à disponibilidade
                                    dos produtos.
                                </p>

                            </section>

                            <section id="precos">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    4. Preços e disponibilidade
                                </h2>

                                <p class="mt-4">
                                    Os preços apresentados na plataforma podem
                                    variar conforme promoções, condições comerciais
                                    e disponibilidade dos produtos.
                                </p>

                                <p class="mt-3">
                                    Em caso de indisponibilidade identificada
                                    após a realização do pedido, o cliente será
                                    informado para que sejam adotadas as medidas
                                    adequadas.
                                </p>

                            </section>

                            <section id="pagamentos">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    5. Pagamentos
                                </h2>

                                <p class="mt-4">
                                    As formas de pagamento disponíveis são
                                    apresentadas durante o processo de compra.
                                </p>

                                <p class="mt-3">
                                    A aprovação da transação pode depender
                                    da instituição financeira ou do prestador
                                    responsável pelo processamento do pagamento.
                                </p>

                                <a
                                    href="{{ route('store.pages.payments') }}"
                                    class="
                                        mt-4 inline-flex
                                        text-sm font-semibold
                                        text-[#315249]
                                        transition hover:text-[#062B25]
                                    "
                                >
                                    Ver formas de pagamento
                                </a>

                            </section>

                            <section id="entregas">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    6. Entregas
                                </h2>

                                <p class="mt-4">
                                    Os prazos de entrega podem variar de acordo
                                    com o endereço informado, modalidade de envio,
                                    disponibilidade dos produtos e condições
                                    da transportadora.
                                </p>

                                <p class="mt-3">
                                    É responsabilidade do cliente informar
                                    corretamente o endereço de entrega.
                                </p>

                                <a
                                    href="{{ route('store.pages.shipping') }}"
                                    class="
                                        mt-4 inline-flex
                                        text-sm font-semibold
                                        text-[#315249]
                                        transition hover:text-[#062B25]
                                    "
                                >
                                    Consultar informações sobre entregas
                                </a>

                            </section>

                            <section id="trocas">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    7. Trocas e devoluções
                                </h2>

                                <p class="mt-4">
                                    Solicitações de troca ou devolução devem
                                    seguir as condições e procedimentos
                                    apresentados na página correspondente.
                                </p>

                                <p class="mt-3">
                                    A análise poderá considerar o estado do
                                    produto, o motivo da solicitação e os
                                    requisitos aplicáveis ao caso.
                                </p>

                                <a
                                    href="{{ route('store.pages.returns') }}"
                                    class="
                                        mt-4 inline-flex
                                        text-sm font-semibold
                                        text-[#315249]
                                        transition hover:text-[#062B25]
                                    "
                                >
                                    Ver política de trocas e devoluções
                                </a>

                            </section>

                            <section id="uso-plataforma">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    8. Uso adequado da plataforma
                                </h2>

                                <p class="mt-4">
                                    O usuário deve utilizar a plataforma de forma
                                    lícita e compatível com sua finalidade.
                                </p>

                                <p class="mt-3">
                                    Não é permitido tentar comprometer a
                                    segurança, funcionamento ou disponibilidade
                                    do sistema, realizar acessos não autorizados
                                    ou utilizar a plataforma para atividades
                                    ilícitas.
                                </p>

                            </section>

                            <section id="responsabilidades">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    9. Responsabilidades
                                </h2>

                                <p class="mt-4">
                                    A Lume busca manter as informações e serviços
                                    disponibilizados na plataforma de forma
                                    adequada e atualizada.
                                </p>

                                <p class="mt-3">
                                    Eventuais indisponibilidades temporárias
                                    podem ocorrer em razão de manutenção,
                                    falhas técnicas ou serviços de terceiros.
                                </p>

                            </section>

                            <section id="alteracoes">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    10. Alterações dos termos
                                </h2>

                                <p class="mt-4">
                                    Estes Termos de Uso poderão ser atualizados
                                    para acompanhar mudanças na plataforma,
                                    nos serviços ou nos requisitos aplicáveis.
                                </p>

                                <p class="mt-3">
                                    A versão atualizada ficará disponível
                                    nesta página.
                                </p>

                            </section>

                            <section id="contato">

                                <h2 class="text-xl font-bold text-[#17231F]">
                                    11. Contato
                                </h2>

                                <p class="mt-4">
                                    Caso tenha dúvidas sobre estes termos ou
                                    sobre a utilização da Lume, entre em contato
                                    com nossa equipe.
                                </p>

                                <a
                                    href="{{ route('store.pages.contact') }}"
                                    class="
                                        mt-5 inline-flex h-10
                                        items-center justify-center
                                        rounded-lg bg-[#062B25]
                                        px-5 text-sm font-semibold
                                        text-white transition
                                        hover:bg-[#0B3C34]
                                    "
                                >
                                    Entrar em contato
                                </a>

                            </section>

                        </div>

                    </div>

                </div>

            </div>

        </x-store.ui.container>

    </section>

</x-store.app-layout>
