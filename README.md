# Lume

E-commerce de livros desenvolvido com Laravel 12, Blade, Alpine.js, Tailwind CSS e Vite. A aplicação reúne loja pública, conta do cliente e painel administrativo, com checkout integrado ao Asaas e logística integrada ao Melhor Envio.

> Este é o guia de entrada do projeto. Consulte o [índice da documentação](docs/README.md) para arquitetura, banco de dados, decisões técnicas e estado de entrega.

## Recursos principais

- catálogo de livros, autores, editoras e categorias;
- URLs públicas amigáveis por slug e galeria interativa de imagens;
- carrinho, cupons, lista de desejos e checkout;
- pagamentos por PIX, boleto e cartão via Asaas;
- cotação, etiqueta e rastreamento via Melhor Envio;
- pedidos e envios visíveis pelo cliente e pelo painel;
- central administrativa de envios com compra, geração e impressão de etiquetas, sincronização de rastreamento e controle do ciclo logístico;
- avaliações com moderação administrativa;
- autenticação e recuperação de senha para clientes e administradores;
- newsletter, formulário de contato, notificações e alertas de sessão;
- cabeçalho responsivo com busca, conta, carrinho e navegação no celular;
- factories e seeders com clientes, catálogo, pedidos, avaliações e envios.

## Requisitos

- PHP 8.2 ou superior;
- Composer;
- Node.js e npm;
- extensões PHP exigidas pelo Laravel;
- MySQL 8.0 ou compatível (padrão do `.env.example`); a suíte de testes usa SQLite em memória automaticamente.

## Instalação

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

No Linux ou macOS, use `cp .env.example .env`. Durante o desenvolvimento, `composer run dev` inicia servidor, fila, logs e Vite em conjunto.

## Integrações externas

Preencha no `.env` apenas quando for utilizar as integrações:

```dotenv
ASAAS_ENVIRONMENT=sandbox
ASAAS_DUE_DAYS=3
ASAAS_SANDBOX_BASE_URL=https://api-sandbox.asaas.com/v3
ASAAS_SANDBOX_API_KEY=
ASAAS_SANDBOX_WEBHOOK_TOKEN=
ASAAS_PRODUCTION_BASE_URL=https://api.asaas.com/v3
ASAAS_PRODUCTION_API_KEY=
ASAAS_PRODUCTION_WEBHOOK_TOKEN=

MELHOR_ENVIO_ENVIRONMENT=sandbox
MELHOR_ENVIO_SANDBOX_CLIENT_ID=
MELHOR_ENVIO_SANDBOX_CLIENT_SECRET=
MELHOR_ENVIO_SANDBOX_WEBHOOK_SECRET=
MELHOR_ENVIO_SANDBOX_BASE_URL=https://sandbox.melhorenvio.com.br/api/v2
MELHOR_ENVIO_SANDBOX_OAUTH_URL=https://sandbox.melhorenvio.com.br
MELHOR_ENVIO_SANDBOX_FROM_POSTAL_CODE=
MELHOR_ENVIO_PRODUCTION_BASE_URL=https://melhorenvio.com.br/api/v2
MELHOR_ENVIO_PRODUCTION_CLIENT_ID=
MELHOR_ENVIO_PRODUCTION_CLIENT_SECRET=
MELHOR_ENVIO_PRODUCTION_WEBHOOK_SECRET=
MELHOR_ENVIO_PRODUCTION_OAUTH_URL=https://melhorenvio.com.br
MELHOR_ENVIO_PRODUCTION_FROM_POSTAL_CODE=
MELHOR_ENVIO_USER_AGENT="Lume contato@seudominio.com.br"
MELHOR_ENVIO_SCOPES="cart-read cart-write shipping-calculate shipping-checkout shipping-generate shipping-print shipping-tracking shipping-cancel"
```

O valor `sandbox` seleciona apenas as credenciais de teste. Para publicar, altere o seletor correspondente para `production`; não duplique nomes de variáveis.

Cadastre no aplicativo do Melhor Envio o webhook `https://seu-dominio.com.br/webhooks/melhor-envio`. A assinatura `X-ME-Signature` é validada com `MELHOR_ENVIO_<AMBIENTE>_WEBHOOK_SECRET`; esse segredo é exclusivo do webhook e **não** deve reutilizar o `CLIENT_SECRET` do OAuth. A URL de callback OAuth é diferente do webhook.

Cadastre como URL de redirecionamento OAuth exatamente `https://seu-dominio.com.br/admin/settings/integrations/melhor-envio/callback`. O domínio gerado pelo Laravel vem de `APP_URL`, que deve usar HTTPS e o endereço público da loja.

Nunca versione tokens reais. Para processar campanhas, notificações e demais tarefas assíncronas, mantenha um worker de fila ativo com `php artisan queue:work`.

### Publicação e segurança

No ambiente de produção, mantenha ao menos estas configurações no `.env` do servidor:

```dotenv
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=warning
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

Após qualquer alteração de ambiente, atualize o cache de configuração:

```bash
php artisan optimize:clear
php artisan config:cache
```

O projeto aplica cabeçalhos de segurança, limite de requisições em endpoints públicos sensíveis e autenticação própria para webhooks. Isso complementa, mas não substitui, HTTPS, backups, monitoramento, credenciais fortes e um worker de fila supervisionado no servidor.

### Administração e envios

Acesse `/admin`. Visitantes são encaminhados para `/admin/login`; administradores autenticados seguem para `/admin/dashboard`.

O menu **Envios** concentra a operação do Melhor Envio. Em cada envio, o administrador pode:

1. preparar a etiqueta, incluindo o pedido no carrinho do Melhor Envio;
2. comprar e gerar a etiqueta;
3. abrir a URL de impressão fornecida pela integração;
4. sincronizar código, link, eventos e status de rastreamento;
5. registrar manualmente postagem, entrega, devolução ou cancelamento quando necessário.

As ações externas só funcionam após configurar Client ID, Client Secret e o CEP de origem do ambiente ativo. Em **Administração > Configurações**, clique em **Conectar Melhor Envio** para autorizar a conta. Access token e refresh token são armazenados criptografados no banco e renovados automaticamente; eles não pertencem ao `.env`. Recomenda-se homologar todo o fluxo no sandbox antes de selecionar `production`.

Para homologação automatizada no Sandbox, use `php artisan melhor-envio:smoke-test` para apenas cotar, `--prepare` para criar e preparar um pedido técnico ou `--purchase` para solicitar confirmação e executar compra, geração e impressão. O comando recusa execução em produção e mantém o pedido criado disponível no painel para inspeção.

## Contas de demonstração

Após executar os seeders:

| Área | E-mail principal | Senha padrão |
| --- | --- | --- |
| Cliente | `cliente@lume.test` | `Lume@2026!Demo` |
| Administração | `admin@lume.test` | `Lume@2026!Admin` |

Usuários e administradores aleatórios criados pelas factories usam a senha padrão da respectiva área. Essas credenciais são exclusivas do ambiente de desenvolvimento.

## Qualidade

```bash
php artisan test
vendor/bin/pint --test
php artisan route:list
php artisan view:cache
```

## Documentação

- [Índice da documentação](docs/README.md): ponto de partida e ordem de leitura;
- [Arquitetura](docs/architecture.md): organização, convenções, segurança e publicação;
- [Banco de dados](docs/database.md): entidades, relacionamentos e integrações persistidas;
- [Decisões técnicas](docs/decisions.md): decisões arquiteturais e respectivas motivações;
- [Roadmap](docs/roadmap.md): estado funcional, homologações pendentes e próximos passos.
