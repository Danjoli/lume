# Organização do projeto

Este documento descreve a estrutura vigente em 21/08/2026. O estado funcional está em `roadmap.md`, a persistência em `database.md` e o histórico de decisões em `decisions.md`.

## Backend

- `Http/Controllers/Admin`: entrada HTTP do painel, agrupada pelo recurso administrativo.
- `Http/Controllers/Store/Catalog`: navegação do catálogo e avaliações.
- `Http/Controllers/Store/Shopping`: carrinho, checkout, pagamento e lista de desejos.
- `Http/Controllers/Store/Content`: home, páginas, contato e newsletter.
- `Http/Controllers/Store/Customer`: autenticação e recursos da conta, subdivididos em `Account`, `Addresses`, `Orders` e `Preferences`.
- `Http/Requests`: autorização e validação de entrada, acompanhando o domínio do Controller que os consome.
- `Services`: casos de uso e integrações, usando a mesma divisão de domínio da camada HTTP.
- `Actions`: uma transição de estado ou operação de domínio reutilizável.
- `Data`: transporte tipado entre request e serviço quando o formulário possuir muitos campos.
- `Models`: relações, casts e regras simples sobre o próprio estado; chamadas externas não pertencem aos models.

Controllers devem permanecer finos: receber request, chamar um serviço/action e escolher a resposta. Integrações com Asaas e Melhor Envio ficam isoladas em serviços próprios.

### Estrutura de domínio

```text
Http/Controllers/Store       Http/Requests/Store       Services/Store
├── Catalog                  ├── Catalog               ├── Catalog
├── Content                  ├── Cart                  ├── Content
├── Customer                 ├── Checkout              ├── Customer
└── Shopping                 ├── Content               ├── Checkout
                             └── Customer              ├── Shipping
                                                       └── Shopping
```

No painel, Controllers, Requests e Services usam o nome do recurso (`Books`, `Orders`, `Shipments`, `Users` etc.). Serviços realmente transversais, como `NotificationService` e `DashboardService`, podem permanecer na raiz da área.

Não é obrigatório criar uma subpasta para cada classe. Uma pasta é criada quando representa um domínio reconhecível, possui mais de uma peça relacionada ou precisa espelhar a estrutura entre camadas. Isso evita tanto arquivos soltos sem padrão quanto hierarquias artificiais de um único arquivo.

### Limites de responsabilidade

- Controller: autorização contextual, chamada do caso de uso e resposta HTTP.
- Form Request: autorização da requisição, normalização simples e mensagens de validação.
- Service: consulta coordenada, transação, regra de negócio ou orquestração externa.
- Action: operação de domínio pequena e reutilizável, especialmente uma transição de estado.
- Model: relações, casts, scopes e comportamento diretamente ligado ao próprio estado.

Avaliações são tratadas por `Store/Catalog/ReviewService`; criação e repetição de cobranças por `Payments/OrderPaymentService`; conciliação financeira por `Payments/AsaasWebhookService`; eventos logísticos por `Store/Shipping/MelhorEnvioWebhookService`. Os respectivos Controllers não consultam nem atualizam essas entidades diretamente.

## Rotas

Os agregadores `routes/admin/routes.php` e `routes/store/routes.php` apenas aplicam middleware e carregam módulos. Cada domínio possui seu arquivo. A área do cliente é subdividida em `routes/store/customer` para evitar um único arquivo concentrando perfil, segurança, endereços e pedidos. Os webhooks externos ficam em `routes/webhooks.php`, mantendo `routes/web.php` apenas como ponto de composição.

As pastas `routes/admin` e `routes/store` permanecem majoritariamente planas: cada arquivo já representa um domínio pequeno e reconhecível. A subpasta `routes/store/customer` existe porque reúne vários módulos sob o mesmo prefixo `minha-conta` (`profile`, `security`, `account`, `addresses`, `orders` e `preferences`). Novas subpastas só devem ser criadas quando um domínio exigir vários arquivos próprios, não apenas para agrupamento visual.

Prefixos não devem ser repetidos dentro do módulo. Por exemplo, o dashboard de relatórios usa `/admin/reports`, e não `/admin/reports/reports`.

`GET /admin` é a entrada canônica do painel. O `Admin/Auth/EntryController` consulta o guard administrativo e encaminha visitantes ao login ou administradores autenticados ao dashboard. As rotas de `admin/shipments.php` expõem separadamente preparação, compra de etiqueta, rastreamento e transições manuais do envio.

Não há `routes/api.php` neste momento por decisão deliberada: a aplicação é servida por Blade e suas integrações externas usam webhooks assinados. Uma API versionada só deve ser introduzida quando existir um consumidor real — por exemplo, aplicativo mobile, integração de parceiros ou front-end separado — junto de autenticação, Resources e contratos próprios.

## Bootstrap e configuração

`bootstrap/app.php` centraliza aliases de middleware, exceções de CSRF estritamente necessárias para webhooks assinados e o carregamento das rotas web e de console. Providers do projeto são registrados em `bootstrap/providers.php`.

O ambiente de referência em `.env.example` usa MySQL, que é o banco da aplicação em desenvolvimento e produção. A suíte de testes continua isolada em SQLite em memória por meio de `phpunit.xml`. O fuso padrão é `America/Sao_Paulo`, mas pode ser alterado com `APP_TIMEZONE` se a operação mudar de região.

A conexão `database` da fila usa `after_commit=true`: jobs só são disponibilizados depois que a transação que os originou foi confirmada, evitando que um worker processe dados ainda não persistidos. Isso exige manter o worker de fila ativo em produção.

## Recursos públicos e traduções

`public/` contém somente arquivos que o navegador pode servir: o front controller, regras de Apache, `robots.txt`, assets compilados pelo Vite, imagens institucionais e os ícones publicados pelo pacote Blade Heroicons. O link `public/storage` é gerado por `php artisan storage:link` e não é versionado.

O favicon oficial é `public/favicon.svg`, usado pelos layouts público, de autenticação e administrativo. Não há fallback `.ico` vazio. Ao trocar a identidade visual, atualize esse SVG e mantenha os layouts apontando para ele.

`lang/pt_BR` contém traduções por grupo do Laravel (`auth`, `passwords` e `validation`). O arquivo `lang/pt_BR.json` traduz frases avulsas da autenticação do Breeze. A pasta é necessária porque a aplicação usa `APP_LOCALE=pt_BR`; novas mensagens reutilizáveis devem ser adicionadas nela, não duplicadas nas views.

## Views

- `components`: elementos reutilizáveis, com API por props/slots.
- `_partials`: blocos específicos de uma única tela ou domínio.
- arquivos `index`, `show`, `create` e `edit`: composição da página, sem grandes blocos internos.

Páginas institucionais usam `x-store.pages.hero`, `x-store.pages.cta` e `x-store.pages.legal-navigation`. Telas administrativas extensas, como newsletter e atendimento, são compostas por partials específicos.

A página de detalhes do livro mantém a galeria em `components/store/books/show/gallery`, com estado local Alpine para alternar a imagem sem nova requisição. No mobile, miniaturas usam rolagem horizontal e a imagem principal reduz sua altura mínima.

O cabeçalho expõe busca, conta, carrinho e menu em telas pequenas. Elementos controlados por Alpine usam `x-cloak` para não aparecer antes da inicialização do JavaScript.

## Assets de front-end

`resources/js/app.js` é o ponto de entrada do Vite: inicializa Alpine e comportamentos reutilizáveis da interface. Alertas de sessão ficam em `resources/js/flash-alerts.js`; os gráficos do dashboard ficam em `resources/js/admin/charts.js` e recebem apenas os dados da view por atributos `data-*`. Assim, Blade continua responsável por renderizar dados e JavaScript por comportamento no navegador.

Estados pequenos e exclusivos de uma view, como abrir menus ou selecionar uma foto da galeria, permanecem próximos ao Blade com Alpine. Não devem virar módulos globais sem reutilização real. O CSS global continua mínimo em `resources/css/app.css` (diretivas Tailwind e `x-cloak`); estilos visuais são compostos com as utilitárias Tailwind nos componentes.

## Testes automatizados

Os testes usam PHPUnit com SQLite em memória, configurado em `phpunit.xml`. Cada cenário de Feature usa `RefreshDatabase`, portanto não consulta nem modifica o banco MySQL local ou de produção.

- `tests/Unit/Models`: regras puras de disponibilidade, preço e transições permitidas de pedido, sem dependência de banco.
- `tests/Feature/Store`: catálogo, URLs amigáveis, perfil e fluxos de compra. Os testes de `Shopping` garantem estoque, acúmulo de quantidade, isolamento de carrinhos e listas de desejos entre clientes.
- `tests/Feature/Admin`: entrada do painel, operações de envio e OAuth do Melhor Envio.
- `tests/Feature/Webhooks`: assinatura HMAC, atualização de rastreio e idempotência do webhook do Melhor Envio.
- `tests/Feature/Auth`: fluxos do Laravel Breeze para clientes.

Para executar a validação completa, use `php artisan test`. Para adicionar uma regra, prefira um teste de Unit apenas quando ela não exigir framework, persistência ou HTTP; caso contrário, use um teste de Feature no domínio correspondente.

## Convenções

- Nomes de rotas: `area.dominio.acao`.
- Recursos públicos com slug: livros, autores, categorias e editoras usam o slug no route model binding; IDs permanecem para entidades sem identificador textual estável.
- Mensagens ao usuário: chaves de sessão `success`, `error`, `warning` ou `info`.
- Valores financeiros: calculados no backend; nunca confiar em preços enviados pelo navegador.
- Consultas públicas de avaliações: somente avaliações aprovadas.
- Segredos e endpoints variáveis: exclusivamente em `.env` e `config/services.php`.
- Integrações externas: adapters próprios em `Services/Payments` e `Services/Store/Shipping`.
- Processamento demorado: Jobs e filas, sem bloquear a resposta HTTP.
- Webhooks: controllers dedicados, autenticação do emissor e processamento idempotente.
- Melhor Envio: `X-ME-Signature` validada por HMAC-SHA256 sobre o corpo bruto, aceitando apenas os client secrets configurados dos aplicativos sandbox e produção.
- OAuth do Melhor Envio: tokens criptografados em `integration_credentials`, separados por ambiente e renovados automaticamente antes da expiração.
- Controle logístico: o painel chama `Services/Admin/Shipments`, que coordena Actions de transição e o adapter do Melhor Envio sem colocar chamadas externas no Controller.
- Pastas e namespaces: nomes em inglês, no plural para domínios de recursos administrativos e por capacidade para módulos da loja.
