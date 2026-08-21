# Lume

E-commerce de livros desenvolvido com Laravel 12, Blade, Alpine.js, Tailwind CSS e Vite. O projeto possui loja pública, conta do cliente e painel administrativo, com checkout integrado ao Asaas e logística integrada ao Melhor Envio.

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
- banco compatível com Laravel (SQLite é o padrão do `.env.example`).

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
MELHOR_ENVIO_SANDBOX_BASE_URL=https://sandbox.melhorenvio.com.br/api/v2
MELHOR_ENVIO_SANDBOX_TOKEN=
MELHOR_ENVIO_SANDBOX_FROM_POSTAL_CODE=
MELHOR_ENVIO_PRODUCTION_BASE_URL=https://melhorenvio.com.br/api/v2
MELHOR_ENVIO_PRODUCTION_CLIENT_ID=
MELHOR_ENVIO_PRODUCTION_CLIENT_SECRET=
MELHOR_ENVIO_PRODUCTION_TOKEN=
MELHOR_ENVIO_PRODUCTION_FROM_POSTAL_CODE=
MELHOR_ENVIO_USER_AGENT="Lume contato@seudominio.com.br"
```

O valor `sandbox` seleciona apenas as credenciais de teste. Para publicar, altere o seletor correspondente para `production`; não duplique nomes de variáveis.

Cadastre no aplicativo do Melhor Envio o webhook `https://seu-dominio.com.br/webhooks/melhor-envio`. A assinatura `X-ME-Signature` é validada com o `CLIENT_SECRET` do ambiente ativo. A URL de callback OAuth é diferente do webhook e ainda depende da implementação do fluxo de autorização.

Nunca versione tokens reais. Para processar campanhas, notificações e demais tarefas assíncronas, mantenha um worker de fila ativo com `php artisan queue:work`.

### Administração e envios

Acesse `/admin`. Visitantes são encaminhados para `/admin/login`; administradores autenticados seguem para `/admin/dashboard`.

O menu **Envios** concentra a operação do Melhor Envio. Em cada envio, o administrador pode:

1. preparar a etiqueta, incluindo o pedido no carrinho do Melhor Envio;
2. comprar e gerar a etiqueta;
3. abrir a URL de impressão fornecida pela integração;
4. sincronizar código, link, eventos e status de rastreamento;
5. registrar manualmente postagem, entrega, devolução ou cancelamento quando necessário.

As ações externas só funcionam após configurar as credenciais e o CEP de origem do ambiente ativo. Recomenda-se homologar todo o fluxo no sandbox antes de selecionar `production`.

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

- `docs/architecture.md`: organização e convenções do código;
- `docs/database.md`: entidades, relacionamentos e integrações persistidas;
- `docs/decisions.md`: decisões técnicas e arquiteturais;
- `docs/roadmap.md`: estado atual e próximos passos.
