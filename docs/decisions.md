# 📋 Decisions - Lume

Registro das principais decisões técnicas e arquiteturais tomadas durante o desenvolvimento do projeto **Lume**.

Este documento serve como histórico das decisões relacionadas à arquitetura, organização do código e modelagem do sistema.

---

# 001 - Separação entre catálogo e vendas

## Decisão

Separar as entidades de catálogo das entidades relacionadas ao processo de venda.

## Motivo

O catálogo representa informações permanentes dos livros:

* livros;
* autores;
* categorias;
* editoras.

O módulo de vendas representa eventos históricos:

* pedidos;
* pagamentos;
* itens comprados.

Essa separação reduz o acoplamento entre módulos e facilita futuras alterações.

---

# 002 - Utilizar tabela book_images

## Decisão

Armazenar imagens dos livros em uma tabela própria.

## Motivo

Um livro pode possuir diferentes imagens:

* capa;
* contracapa;
* imagens internas;
* imagens promocionais.

Estrutura:

```text
Book

1 : N

BookImages
```

Benefícios:

* múltiplas imagens;
* definição de imagem principal;
* ordenação;
* maior flexibilidade.

---

# 003 - Relacionamento muitos-para-muitos entre livros e autores

## Decisão

Criar a tabela pivô `book_author`.

## Motivo

Um livro pode possuir:

* um autor;
* múltiplos autores;
* organizadores;
* colaboradores.

Um autor também pode participar de diversos livros.

---

# 004 - Categorias hierárquicas

## Decisão

Adicionar o campo `parent_id` na tabela `categories`.

## Motivo

Permitir criação de categorias e subcategorias.

Exemplo:

```text
Tecnologia
├── Programação
├── Banco de Dados
└── Redes
```

Essa abordagem evita múltiplas tabelas para diferentes níveis.

---

# 005 - Snapshot dos pedidos

## Decisão

Salvar uma cópia dos dados no momento da criação do pedido.

## Motivo

Pedidos representam registros históricos.

Alterações futuras no catálogo ou endereço não devem modificar pedidos já realizados.

São armazenados:

* título do livro;
* preço;
* quantidade;
* endereço;
* destinatário;
* valores da compra.

---

# 006 - Controllers enxutos

## Decisão

Evitar regras de negócio dentro dos Controllers.

## Motivo

Controllers devem apenas:

* receber requisições;
* validar dados;
* chamar Services;
* retornar respostas.

Regras complexas ficam em camadas específicas.

---

# 007 - Utilizar Form Requests

## Decisão

Centralizar validações utilizando Form Requests.

## Motivo

Evitar validações espalhadas pelos Controllers.

Benefícios:

* organização;
* reutilização;
* mensagens personalizadas;
* código mais limpo.

---

# 008 - Utilizar Enums

## Decisão

Utilizar PHP Enums para estados e valores fixos do sistema.

## Aplicado em

* AdminRole;
* OrderStatus;
* PaymentStatus;
* ShipmentStatus.

## Motivo

Evitar valores inválidos e erros de digitação.

---

# 009 - Utilizar Soft Deletes

## Decisão

Utilizar Soft Deletes nas entidades onde o histórico é importante.

## Aplicado em

* Admins;
* Users.

## Motivo

Permitir:

* recuperação de registros;
* preservação histórica;
* futura auditoria.

---

# 010 - Separação entre Administradores e Clientes

## Decisão

Utilizar autenticações separadas para administradores e clientes.

## Motivo

Os dois grupos possuem responsabilidades diferentes.

Administradores:

* gerenciam catálogo;
* gerenciam pedidos;
* administram usuários.

Clientes:

* realizam compras;
* acompanham pedidos;
* gerenciam seu perfil.

---

# 011 - Camada de Services

## Decisão

Centralizar regras de negócio em Services.

## Exemplos

* CheckoutService;
* CartService;
* PaymentService;
* ShippingService.

## Motivo

Facilitar:

* manutenção;
* testes;
* reutilização.

---

# 012 - Banco preparado para crescimento

## Decisão

Projetar o banco considerando futuras expansões.

## Funcionalidades previstas

* avaliações;
* lista de desejos;
* múltiplas imagens;
* múltiplos autores;
* categorias hierárquicas.

---

# 013 - Utilizar Slugs

## Decisão

Utilizar slugs únicos nas entidades públicas.

## Aplicado em

* Books;
* Authors;
* Categories;
* Publishers.

## Motivo

Melhorar:

* URLs amigáveis;
* SEO;
* navegação.

Exemplo:

```text
/livros/clean-code

/autores/robert-c-martin
```

---

# 014 - Organização por responsabilidade

## Decisão

Separar responsabilidades dentro da aplicação.

## Estrutura

```text
Controllers
    ↓
Form Requests
    ↓
Services
    ↓
Models
    ↓
Database
```

## Motivo

Facilitar manutenção e evolução do projeto.

---

# 015 - Documentação do projeto

## Decisão

Manter documentação técnica dentro da pasta `docs/`.

## Arquivos

* architecture.md
* database.md
* roadmap.md
* decisions.md

## Motivo

Centralizar informações importantes do projeto.

---

# 016 - Separação do controle de entrega em Shipment

## Decisão

Criar uma entidade própria para controlar os envios.

## Motivo

Pedido e logística possuem responsabilidades diferentes.

## Pedido:

* compra;
* pagamento;
* valores.

## Shipment:

* transportadora;
* rastreamento;
* entrega;
* status de envio.

## Benefícios:

* integração futura com transportadoras;
* controle de rastreamento;
* evolução da logística.

---

# 017 - Utilizar Factories para geração de dados

## Decisão

Criar Factories para as principais entidades do sistema.

## Motivo

Separar a criação de dados dos Seeders.

Factories definem como um registro é criado.

Seeders definem quais dados serão inseridos.

Benefícios:

* testes mais simples;
* criação rápida de ambientes;
* dados consistentes;
* melhor organização.

Exemplos:

* UserFactory;
* BookFactory;
* OrderFactory;
* ShipmentFactory.

---

# 018 - Utilizar Seeders para dados iniciais

## Decisão

Utilizar Seeders para controlar a população inicial do banco de desenvolvimento.

## Motivo

Permitir criação rápida de ambientes para desenvolvimento e testes.

Seeders são responsáveis por:

* definir ordem de criação;
* criar dados relacionados;
* preparar cenários de teste.

---

# 019 - Tabelas Pivot sem Models próprios

## Decisão

Não criar Models para tabelas intermediárias utilizadas apenas como relacionamento.

## Aplicado em

* book_category;
* book_author.

## Motivo

Essas tabelas possuem apenas a função de ligação entre entidades.

---

# 020 - Status utilizando Enums

## Decisão

Utilizar Enums para estados importantes do sistema.

## Aplicado em

* AdminRole;
* ShipmentStatus;
* PaymentStatus;
* OrderStatus.

## Motivo

Garantir padronização dos valores e reduzir erros.

---

# 021 - Utilização de Observers para eventos de Models

## Decisão

Utilizar Observers para executar ações automáticas relacionadas aos Models.

## Motivo

Algumas operações devem acontecer automaticamente durante criação ou atualização de registros.

Exemplos:

- geração de slug;
- atualização de campos derivados;
- normalização de dados.

Inicialmente foram criados:


BookObserver

AuthorObserver

PublisherObserver

CategoryObserver


Benefícios:

- separação de responsabilidades;
- Controllers menores;
- regras automáticas centralizadas;
- melhor manutenção do código.

# 022 - Autenticação

## Cliente

A autenticação dos clientes utiliza o sistema padrão do Laravel Breeze.

Configurações:

- Guard: web
- Provider: users
- Model: User

Recursos implementados:

- cadastro;
- login;
- logout;
- recuperação de senha;
- verificação de email;
- gerenciamento de perfil.


## Administrador

Administradores possuem autenticação separada dos clientes.

Configurações:

- Guard: admin
- Provider: admins
- Model: Admin

A autenticação administrativa possui:

- login separado;
- logout separado;
- middleware próprio;
- rotas protegidas;
- layout próprio.


Estrutura:

Admin
    |
    ├── AdminMiddleware
    |
    ├── Admin Guard
    |
    └── Admin Controller


Cliente
    |
    ├── Breeze Auth
    |
    ├── Web Guard
    |
    └── Customer Controllers

# Histórico de decisões

| Data       | Alteração                                                         |
| ---------- | ---------------------------------------------------------         |
| 27/07/2026 | Estrutura inicial do banco de dados definida                      |
| 27/07/2026 | Arquitetura Laravel definida                                      |
| 27/07/2026 | Separação dos módulos catálogo, cliente e vendas                  |
| 28/07/2026 | Implementação dos Models, Enums e Relacionamentos                 |
| 28/07/2026 | Implementação das Factories                                       |
| 28/07/2026 | Testes das Factories realizados                                   |
| 28/07/2026 | Implementação dos Seeders iniciais                                |
| 28/07/2026 | Documentação atualizada após conclusão da camada de dados         |
| 29/07/2026 | Policies e Observers implementados                                |
| 29/07/2026 | Autenticação de clientes configurada com Laravel Breeze           |
| 29/07/2026 | Autenticação administrativa separada implementada com guard admin |
| 29/07/2026 | Middleware e rotas protegidas do painel administrativo criados    |
| 29/07/2026 | Layouts e componentes Blade separados por contexto                |
| 20/08/2026 | Checkout e pagamentos integrados ao Asaas                         |
| 20/08/2026 | Logística integrada ao Melhor Envio                              |
| 21/08/2026 | Autenticação, avaliações, alertas e dados de demonstração revistos |
| 21/08/2026 | Rotas, Services e views reorganizados por domínio                 |
| 21/08/2026 | Suíte de autenticação e perfil alinhada ao fluxo atual             |

# 023 - Integrações externas isoladas

## Decisão

Manter Asaas e Melhor Envio em serviços próprios, configurados por `config/services.php` e variáveis de ambiente.

## Motivo

Evitar chamadas externas em Controllers ou Models, impedir segredos no código e permitir troca de ambiente entre sandbox e produção.

# 024 - Webhooks como fonte de conciliação

## Decisão

Receber eventos do Asaas por endpoint dedicado, validar o token configurado e tornar a atualização de pagamento idempotente.

## Motivo

O retorno do navegador não é garantia de pagamento. A confirmação deve vir do gateway e eventos repetidos não podem duplicar efeitos.

# 025 - Rotas organizadas por domínio

## Decisão

Usar arquivos agregadores para as áreas administrativa e pública e subdividir a conta do cliente em perfil, segurança, conta, endereços e pedidos.

## Motivo

Arquivos menores facilitam localização, revisão de middleware e manutenção de nomes de rota.

# 026 - Componentes e partials nas views

## Decisão

Usar componentes Blade para interfaces reutilizáveis e `_partials` para blocos específicos de uma tela ou domínio.

## Motivo

Reduzir duplicação sem transformar cada trecho visual em uma abstração global. Arquivos `index`, `show`, `create` e `edit` devem priorizar composição.

# 027 - Dados de demonstração coerentes

## Decisão

Factories e seeders geram clientes com pedidos, itens, avaliações e envios em estados variados, usando senhas conhecidas somente em desenvolvimento.

## Motivo

Permitir testar dashboards e fluxos reais sem cadastros manuais. Credenciais de demonstração nunca devem ser utilizadas em produção.

# 028 - Alertas e validação localizados

## Decisão

Centralizar validações em Form Requests e apresentar retornos de sucesso, erro, aviso e informação por um componente compartilhado, com mensagens em português.

## Motivo

Oferecer comportamento consistente entre loja e painel e evitar mensagens internas do framework na interface.

# 029 - Camadas espelhadas por domínio

## Decisão

Organizar Controllers, Form Requests e Services pelos mesmos limites de domínio. Na loja, os grupos principais são `Catalog`, `Shopping`, `Content` e `Customer`; no painel, cada recurso mantém sua pasta correspondente.

## Motivo

Facilitar a descoberta dos arquivos de um caso de uso sem criar uma pasta para cada classe. Serviços transversais permanecem na raiz e integrações financeiras ficam em `Services/Payments`.

# 030 - Controllers sem persistência de regras de negócio

## Decisão

Extrair elegibilidade e moderação de avaliações, orquestração de cobranças e conciliação de webhooks para Services dedicados.

## Motivo

Manter a camada HTTP pequena e testável, centralizar transações e permitir reutilização das regras fora de uma rota web.

# 031 - Estrutura de rotas rasa por padrão

## Decisão

Manter `routes/admin` e os módulos principais de `routes/store` planos, com um arquivo por domínio. A conta do cliente permanece em `routes/store/customer` porque compartilha o prefixo `minha-conta` e possui vários módulos relacionados.

## Motivo

Evitar hierarquias sem ganho prático e manter os arquivos fáceis de localizar. Uma nova subpasta só é criada quando o próprio domínio passa a precisar de vários arquivos.

# 032 - Webhook logístico autenticado

## Decisão

Receber eventos de etiqueta do Melhor Envio em `/webhooks/melhor-envio`, validando `X-ME-Signature` com HMAC-SHA256 e um segredo dedicado de webhook do ambiente correspondente.

## Motivo

Atualizar rastreamento sem depender exclusivamente de consultas manuais, rejeitar payloads sem autenticidade e tolerar reenvios ou eventos atrasados sem regredir o estado logístico.

# 033 - URLs públicas por slug

## Decisão

Usar `slug` como chave de rota de livros, autores, categorias e editoras. Entidades transacionais ou sem nome público estável continuam utilizando seu identificador interno.

## Motivo

Produzir endereços legíveis, compartilháveis e adequados para indexação sem aplicar slugs artificiais a pedidos, usuários ou registros operacionais.

# 034 - Endurecimento de rotas e navegador

## Decisão

Aplicar cabeçalhos de segurança em todas as respostas, limitar rotas públicas sensíveis e separar segredos de webhook dos segredos OAuth.

## Motivo

Reduzir superfícies de spam, clickjacking, interpretação indevida de conteúdo e reutilização de credenciais, sem substituir autenticação, CSRF ou validação de assinatura existentes.
