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

Os agregadores `routes/admin/routes.php` e `routes/store/routes.php` apenas aplicam middleware e carregam módulos. Cada domínio possui seu arquivo. A área do cliente é subdividida em `routes/store/customer` para evitar um único arquivo concentrando perfil, segurança, endereços e pedidos.

As pastas `routes/admin` e `routes/store` permanecem majoritariamente planas: cada arquivo já representa um domínio pequeno e reconhecível. A subpasta `routes/store/customer` existe porque reúne vários módulos sob o mesmo prefixo `minha-conta` (`profile`, `security`, `account`, `addresses`, `orders` e `preferences`). Novas subpastas só devem ser criadas quando um domínio exigir vários arquivos próprios, não apenas para agrupamento visual.

Prefixos não devem ser repetidos dentro do módulo. Por exemplo, o dashboard de relatórios usa `/admin/reports`, e não `/admin/reports/reports`.

`GET /admin` é a entrada canônica do painel. O `Admin/Auth/EntryController` consulta o guard administrativo e encaminha visitantes ao login ou administradores autenticados ao dashboard. As rotas de `admin/shipments.php` expõem separadamente preparação, compra de etiqueta, rastreamento e transições manuais do envio.

## Views

- `components`: elementos reutilizáveis, com API por props/slots.
- `_partials`: blocos específicos de uma única tela ou domínio.
- arquivos `index`, `show`, `create` e `edit`: composição da página, sem grandes blocos internos.

Páginas institucionais usam `x-store.pages.hero`, `x-store.pages.cta` e `x-store.pages.legal-navigation`. Telas administrativas extensas, como newsletter e atendimento, são compostas por partials específicos.

A página de detalhes do livro mantém a galeria em `components/store/books/show/gallery`, com estado local Alpine para alternar a imagem sem nova requisição. No mobile, miniaturas usam rolagem horizontal e a imagem principal reduz sua altura mínima.

O cabeçalho expõe busca, conta, carrinho e menu em telas pequenas. Elementos controlados por Alpine usam `x-cloak` para não aparecer antes da inicialização do JavaScript.

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
