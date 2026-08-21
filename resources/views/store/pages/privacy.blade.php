<x-store.app-layout title="Política de Privacidade">

    <x-store.pages.hero eyebrow="Institucional" title="Política de Privacidade" description="Entenda como a Lume trata as informações fornecidas durante sua navegação e utilização da nossa loja." updated-at="agosto de 2026" />

    {{-- Conteúdo --}}
    <section class="py-14 lg:py-20">

        <x-store.ui.container>

            <div
                class="
                    mx-auto grid max-w-5xl gap-12
                    lg:grid-cols-[220px_minmax(0,1fr)]
                "
            >

                <x-store.pages.legal-navigation :items="['introducao' => 'Introdução', 'dados-coletados' => 'Dados coletados', 'uso-dados' => 'Uso das informações', 'compartilhamento' => 'Compartilhamento', 'seguranca' => 'Segurança', 'cookies' => 'Cookies', 'direitos' => 'Seus direitos', 'alteracoes' => 'Alterações', 'contato' => 'Contato']" />

                {{-- Política --}}
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

                            <section id="introducao">

                                <h2
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >
                                    1. Introdução
                                </h2>

                                <p class="mt-4">
                                    A Lume valoriza a privacidade de seus
                                    usuários e clientes. Esta Política de
                                    Privacidade apresenta, de forma geral,
                                    como as informações podem ser coletadas,
                                    utilizadas e protegidas durante o uso
                                    da nossa plataforma.
                                </p>

                                <p class="mt-3">
                                    Ao utilizar nossos serviços, você poderá
                                    fornecer determinadas informações
                                    necessárias para criação de conta,
                                    realização de compras, entrega de pedidos
                                    e atendimento.
                                </p>

                            </section>

                            <section id="dados-coletados">

                                <h2
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >
                                    2. Dados que podemos coletar
                                </h2>

                                <p class="mt-4">
                                    Dependendo da forma como você utiliza
                                    a Lume, podemos receber informações como:
                                </p>

                                <ul class="mt-4 list-disc space-y-2 pl-5">

                                    <li>
                                        nome e informações de identificação;
                                    </li>

                                    <li>
                                        endereço de e-mail;
                                    </li>

                                    <li>
                                        telefone;
                                    </li>

                                    <li>
                                        endereço utilizado para entrega;
                                    </li>

                                    <li>
                                        informações relacionadas aos pedidos;
                                    </li>

                                    <li>
                                        informações necessárias para
                                        atendimento ao cliente;
                                    </li>

                                    <li>
                                        dados técnicos relacionados ao acesso
                                        e utilização da plataforma.
                                    </li>

                                </ul>

                            </section>

                            <section id="uso-dados">

                                <h2
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >
                                    3. Como utilizamos as informações
                                </h2>

                                <p class="mt-4">
                                    As informações podem ser utilizadas para
                                    permitir o funcionamento da loja e prestar
                                    os serviços solicitados pelo usuário.
                                </p>

                                <p class="mt-3">
                                    Isso pode incluir processamento de pedidos,
                                    entrega de produtos, comunicação sobre
                                    compras, atendimento, segurança da
                                    plataforma e melhoria da experiência
                                    oferecida pela Lume.
                                </p>

                            </section>

                            <section id="compartilhamento">

                                <h2
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >
                                    4. Compartilhamento de informações
                                </h2>

                                <p class="mt-4">
                                    Algumas informações podem precisar ser
                                    compartilhadas com prestadores de serviços
                                    necessários para a execução de uma compra,
                                    como serviços de pagamento, transporte,
                                    infraestrutura e outras soluções utilizadas
                                    no funcionamento da plataforma.
                                </p>

                                <p class="mt-3">
                                    O compartilhamento deve se limitar às
                                    informações necessárias para a prestação
                                    do respectivo serviço ou para o cumprimento
                                    de obrigações aplicáveis.
                                </p>

                            </section>

                            <section id="seguranca">

                                <h2
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >
                                    5. Segurança das informações
                                </h2>

                                <p class="mt-4">
                                    Buscamos adotar medidas técnicas e
                                    organizacionais adequadas para proteger
                                    informações contra acessos não autorizados,
                                    perda, alteração ou divulgação indevida.
                                </p>

                                <p class="mt-3">
                                    Apesar das medidas de proteção adotadas,
                                    nenhum sistema conectado à internet pode
                                    garantir segurança absoluta.
                                </p>

                            </section>

                            <section id="cookies">

                                <h2
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >
                                    6. Cookies e tecnologias semelhantes
                                </h2>

                                <p class="mt-4">
                                    A plataforma poderá utilizar cookies e
                                    tecnologias semelhantes necessários para
                                    funcionalidades como autenticação,
                                    manutenção de sessão, preferências e
                                    funcionamento adequado da loja.
                                </p>

                            </section>

                            <section id="direitos">

                                <h2
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >
                                    7. Seus direitos
                                </h2>

                                <p class="mt-4">
                                    Conforme a legislação aplicável, você pode
                                    possuir direitos relacionados aos seus
                                    dados pessoais, incluindo solicitar
                                    informações sobre o tratamento realizado
                                    e, quando aplicável, correção ou exclusão
                                    de determinadas informações.
                                </p>

                                <p class="mt-3">
                                    Algumas informações poderão precisar ser
                                    mantidas pelo período necessário para
                                    cumprimento de obrigações legais,
                                    regulatórias ou exercício de direitos.
                                </p>

                            </section>

                            <section id="alteracoes">

                                <h2
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >
                                    8. Alterações nesta política
                                </h2>

                                <p class="mt-4">
                                    Esta Política de Privacidade poderá ser
                                    atualizada para refletir mudanças na
                                    plataforma, nos serviços oferecidos ou
                                    em requisitos aplicáveis.
                                </p>

                                <p class="mt-3">
                                    Quando houver alterações, a versão
                                    atualizada será disponibilizada nesta
                                    página.
                                </p>

                            </section>

                            <section id="contato">

                                <h2
                                    class="
                                        text-xl font-bold
                                        text-[#17231F]
                                    "
                                >
                                    9. Contato
                                </h2>

                                <p class="mt-4">
                                    Caso tenha dúvidas relacionadas à
                                    privacidade ou ao tratamento de suas
                                    informações, entre em contato com
                                    nossa equipe.
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
