# 🗄️ Database - Lume

Documentação da estrutura do banco de dados do **Lume**, um e-commerce de livros desenvolvido com Laravel.

O banco foi projetado priorizando:

* Normalização dos dados;
* Escalabilidade;
* Integridade referencial;
* Performance nas consultas;
* Facilidade de manutenção.

---

# Status

## ✅ Implementado

* Migrations
* Relacionamentos
* Models Eloquent
* Enums
* Factories
* Seeders

---

# Diagrama geral

```text
                    publishers
                         │
                         │
                      books
                 ┌────┼────┐
                 │    │    │
                 │    │    └───────────────┐
                 │    │                    │
             authors categories      book_images
                 ▲         ▲
                 │         │
          book_author  book_category


users
 │
 ├── addresses
 │
 ├── carts
 │      │
 │      └── cart_items
 │
 ├── orders
 │      │
 │      ├── order_items
 │      │
 │      └── shipments
 │
 ├── reviews
 │
 └── wishlists
```

---

# Administração

## admins

Armazena os usuários administrativos responsáveis pelo gerenciamento da plataforma.

### Relacionamento

```text
Admin

Utilizado para autenticação do painel administrativo
```

### Campos

| Campo         | Tipo      | Descrição            |
| ------------- | --------- | -------------------- |
| id            | bigint    | Identificador        |
| name          | string    | Nome                 |
| email         | string    | E-mail               |
| password      | string    | Senha criptografada  |
| role          | string    | Cargo administrativo |
| is_active     | boolean   | Conta ativa          |
| last_login_at | timestamp | Último acesso        |
| created_at    | timestamp | Data de criação      |
| updated_at    | timestamp | Data de atualização  |
| deleted_at    | timestamp | Soft Delete          |

---

# Usuários

## users

Representa os clientes da loja.

### Relacionamentos

```text
User

hasMany Addresses

hasOne Cart

hasMany Orders

hasMany Reviews

belongsToMany Books (Wishlist)
```

### Campos

| Campo             | Tipo      | Descrição             |
| ----------------- | --------- | --------------------- |
| id                | bigint    | Identificador         |
| name              | string    | Nome                  |
| email             | string    | E-mail                |
| email_verified_at | timestamp | Verificação do e-mail |
| password          | string    | Senha                 |
| status            | string    | Status da conta       |
| last_login_at     | timestamp | Último login          |
| remember_token    | string    | Token lembrar-me      |
| created_at        | timestamp | Data de criação       |
| updated_at        | timestamp | Data de atualização   |
| deleted_at        | timestamp | Soft Delete           |

---

# Catálogo

## authors

Armazena os autores cadastrados na plataforma.

Um autor pode participar de vários livros e um livro pode possuir vários autores.

### Relacionamentos

```text
Author

belongsToMany Books
```

### Campos

| Campo      | Tipo      | Descrição           |
| ---------- | --------- | ------------------- |
| id         | bigint    | Identificador       |
| name       | string    | Nome                |
| slug       | string    | URL amigável        |
| biography  | text      | Biografia           |
| photo      | string    | Foto                |
| is_active  | boolean   | Status              |
| created_at | timestamp | Data de criação     |
| updated_at | timestamp | Data de atualização |

---

## publishers

Armazena as editoras responsáveis pelos livros.

Uma editora pode possuir vários livros publicados.

### Relacionamentos

```text
Publisher

hasMany Books
```

### Campos

| Campo       | Tipo      | Descrição           |
| ----------- | --------- | ------------------- |
| id          | bigint    | Identificador       |
| name        | string    | Nome                |
| slug        | string    | URL amigável        |
| description | text      | Descrição           |
| website     | string    | Site oficial        |
| logo        | string    | Logo                |
| is_active   | boolean   | Status              |
| created_at  | timestamp | Data de criação     |
| updated_at  | timestamp | Data de atualização |

---

## categories

Representa as categorias dos livros.

A estrutura permite categorias e subcategorias através do relacionamento hierárquico.

Exemplo:

```text
Tecnologia

├── Programação
├── Banco de Dados
└── Redes
```

### Relacionamentos

```text
Category

belongsToMany Books

belongsTo Category (parent)

hasMany Categories (children)
```

### Campos

| Campo       | Tipo      | Descrição           |
| ----------- | --------- | ------------------- |
| id          | bigint    | Identificador       |
| name        | string    | Nome                |
| slug        | string    | URL amigável        |
| description | text      | Descrição           |
| parent_id   | bigint    | Categoria pai       |
| is_active   | boolean   | Status              |
| created_at  | timestamp | Data de criação     |
| updated_at  | timestamp | Data de atualização |

---

## books

Tabela principal do catálogo.

Representa os livros disponíveis para venda.

### Relacionamentos

```text
Book

belongsTo Publisher

belongsToMany Authors

belongsToMany Categories

hasMany BookImages

hasMany Reviews

hasMany CartItems

hasMany OrderItems

hasMany Wishlists
```

### Campos

| Campo            | Tipo      | Descrição             |
| ---------------- | --------- | --------------------- |
| id               | bigint    | Identificador         |
| title            | string    | Título                |
| slug             | string    | URL amigável          |
| isbn             | string    | ISBN                  |
| description      | text      | Descrição             |
| synopsis         | longText  | Sinopse               |
| price            | decimal   | Preço                 |
| sale_price       | decimal   | Preço promocional     |
| stock            | integer   | Estoque               |
| pages            | integer   | Quantidade de páginas |
| language         | string    | Idioma                |
| edition          | string    | Edição                |
| format           | string    | Formato               |
| publication_date | date      | Data de publicação    |
| weight           | decimal   | Peso                  |
| height           | decimal   | Altura                |
| width            | decimal   | Largura               |
| length           | decimal   | Comprimento           |
| publisher_id     | bigint    | Editora               |
| is_featured      | boolean   | Livro em destaque     |
| is_active        | boolean   | Disponibilidade       |
| created_at       | timestamp | Data de criação       |
| updated_at       | timestamp | Data de atualização   |

---

## book_images

Armazena as imagens relacionadas aos livros.

Um livro pode possuir múltiplas imagens.

### Relacionamentos

```text
BookImage

belongsTo Book
```

### Campos

| Campo      | Tipo      | Descrição               |
| ---------- | --------- | ----------------------- |
| id         | bigint    | Identificador           |
| book_id    | bigint    | Livro                   |
| image      | string    | Caminho da imagem       |
| sort_order | integer   | Ordem de exibição       |
| is_primary | boolean   | Define imagem principal |
| created_at | timestamp | Data de criação         |
| updated_at | timestamp | Data de atualização     |

---

## book_author

Tabela intermediária responsável pelo relacionamento muitos-para-muitos entre livros e autores.

### Relacionamentos

```text
Book

belongsToMany Authors


Author

belongsToMany Books
```

### Campos

| Campo     | Tipo   |
| --------- | ------ |
| book_id   | bigint |
| author_id | bigint |

---

## book_category

Tabela intermediária responsável pelo relacionamento muitos-para-muitos entre livros e categorias.

### Relacionamentos

```text
Book

belongsToMany Categories


Category

belongsToMany Books
```

### Campos

| Campo       | Tipo   |
| ----------- | ------ |
| book_id     | bigint |
| category_id | bigint |

---

# Cliente

## addresses

Armazena os endereços cadastrados pelos clientes.

### Relacionamentos

```text
Address

belongsTo User
```

### Campos

| Campo          | Tipo      | Descrição           |
| -------------- | --------- | ------------------- |
| id             | bigint    | Identificador       |
| user_id        | bigint    | Usuário             |
| label          | string    | Nome do endereço    |
| recipient_name | string    | Destinatário        |
| phone          | string    | Telefone            |
| street         | string    | Rua                 |
| number         | string    | Número              |
| complement     | string    | Complemento         |
| neighborhood   | string    | Bairro              |
| city           | string    | Cidade              |
| state          | string    | Estado              |
| cep            | string    | CEP                 |
| is_default     | boolean   | Endereço principal  |
| created_at     | timestamp | Data de criação     |
| updated_at     | timestamp | Data de atualização |

---

## carts

Representa o carrinho de compras do usuário.

Cada usuário possui um carrinho.

### Relacionamentos

```text
Cart

belongsTo User

hasMany CartItems
```

### Campos

| Campo      | Tipo      |
| ---------- | --------- |
| id         | bigint    |
| user_id    | bigint    |
| created_at | timestamp |
| updated_at | timestamp |

---

## cart_items

Representa os livros adicionados ao carrinho.

### Relacionamentos

```text
CartItem

belongsTo Cart

belongsTo Book
```

### Campos

| Campo      | Tipo      |
| ---------- | --------- |
| id         | bigint    |
| cart_id    | bigint    |
| book_id    | bigint    |
| quantity   | integer   |
| created_at | timestamp |
| updated_at | timestamp |

---

# Vendas

## orders

Representa um pedido realizado por um cliente.

A tabela mantém um **snapshot** das informações da compra no momento da realização do pedido.

Mesmo que o livro, preço ou endereço sejam alterados posteriormente, o pedido permanece com os dados originais.

### Relacionamentos

```text
Order

belongsTo User

hasMany OrderItems

hasOne Shipment
```

### Campos

| Campo              | Tipo      | Descrição                       |
| ------------------ | --------- | ------------------------------- |
| id                 | bigint    | Identificador                   |
| user_id            | bigint    | Cliente responsável pelo pedido |
| status             | string    | Status do pedido                |
| payment_status     | string    | Status do pagamento             |
| subtotal           | decimal   | Valor dos produtos              |
| shipping           | decimal   | Valor do frete                  |
| discount           | decimal   | Desconto aplicado               |
| total              | decimal   | Valor total                     |
| recipient_name     | string    | Nome do destinatário            |
| phone              | string    | Telefone                        |
| street             | string    | Rua                             |
| number             | string    | Número                          |
| complement         | string    | Complemento                     |
| neighborhood       | string    | Bairro                          |
| city               | string    | Cidade                          |
| state              | string    | Estado                          |
| cep                | string    | CEP                             |
| gateway            | string    | Gateway de pagamento            |
| gateway_payment_id | string    | ID da transação                 |
| paid_at            | timestamp | Data do pagamento               |
| created_at         | timestamp | Data de criação                 |
| updated_at         | timestamp | Data de atualização             |

---

## order_items

Representa os itens pertencentes a um pedido.

Mantém uma cópia das informações do livro no momento da compra.

Isso evita que alterações futuras no catálogo alterem pedidos antigos.

### Relacionamentos

```text
OrderItem

belongsTo Order

belongsTo Book
```

### Campos

| Campo      | Tipo      | Descrição                          |
| ---------- | --------- | ---------------------------------- |
| id         | bigint    | Identificador                      |
| order_id   | bigint    | Pedido                             |
| book_id    | bigint    | Livro                              |
| title      | string    | Nome do livro no momento da compra |
| price      | decimal   | Preço pago                         |
| quantity   | integer   | Quantidade comprada                |
| created_at | timestamp | Data de criação                    |
| updated_at | timestamp | Data de atualização                |

---

# Envios

## shipments

Responsável pelo controle logístico dos pedidos.

Essa entidade é separada de pedidos porque compra e entrega possuem responsabilidades diferentes.

O pedido controla:

* produtos;
* valores;
* pagamento.

O envio controla:

* transportadora;
* rastreamento;
* entrega.

### Relacionamento

```text
Shipment

belongsTo Order
```

### Campos

| Campo         | Tipo      | Descrição           |
| ------------- | --------- | ------------------- |
| id            | bigint    | Identificador       |
| order_id      | bigint    | Pedido relacionado  |
| carrier       | string    | Transportadora      |
| tracking_code | string    | Código de rastreio  |
| service       | string    | Serviço contratado  |
| status        | string    | Status do envio     |
| shipping_cost | decimal   | Valor do frete      |
| shipped_at    | timestamp | Data de postagem    |
| delivered_at  | timestamp | Data de entrega     |
| created_at    | timestamp | Data de criação     |
| updated_at    | timestamp | Data de atualização |

---

# Interações

## reviews

Representa as avaliações realizadas pelos clientes.

Um usuário pode avaliar vários livros e um livro pode possuir várias avaliações.

### Relacionamentos

```text
Review

belongsTo User

belongsTo Book
```

### Campos

| Campo       | Tipo      | Descrição           |
| ----------- | --------- | ------------------- |
| id          | bigint    | Identificador       |
| user_id     | bigint    | Usuário             |
| book_id     | bigint    | Livro               |
| rating      | integer   | Nota da avaliação   |
| comment     | text      | Comentário          |
| is_approved | boolean   | Avaliação aprovada  |
| created_at  | timestamp | Data de criação     |
| updated_at  | timestamp | Data de atualização |

---

## wishlists

Representa a lista de desejos dos usuários.

Essa tabela também funciona como uma tabela intermediária para o relacionamento muitos-para-muitos entre usuários e livros.

### Relacionamentos

```text
Wishlist

belongsTo User

belongsTo Book
```

### Campos

| Campo      | Tipo      | Descrição           |
| ---------- | --------- | ------------------- |
| id         | bigint    | Identificador       |
| user_id    | bigint    | Usuário             |
| book_id    | bigint    | Livro               |
| created_at | timestamp | Data de criação     |
| updated_at | timestamp | Data de atualização |

---

# Convenções

## Chaves primárias

Todas as tabelas utilizam:

```text
id
```

como chave primária utilizando:

```text
bigint unsigned
```

---

## Chaves estrangeiras

As Foreign Keys seguem o padrão do Laravel:

```text
user_id

admin_id

book_id

author_id

category_id

publisher_id

order_id

cart_id
```

As relações utilizam integridade referencial através de constraints.

---

## Timestamps

As tabelas utilizam:

```text
created_at

updated_at
```

Quando necessário:

```text
deleted_at
```

para Soft Deletes.

---

## Soft Deletes

Utilizado nas entidades onde o histórico precisa ser preservado.

Atualmente aplicado em:

* admins;
* users.

Outras entidades podem receber Soft Delete futuramente conforme necessidade.

---

## Slugs

As entidades públicas utilizam slugs únicos para URLs amigáveis e SEO.

Aplicado em:

* Books;
* Authors;
* Categories;
* Publishers.

Exemplo:

```text
/livros/clean-code

/autores/robert-c-martin

/categorias/programacao
```

---

## Índices

Foram adicionados índices em campos utilizados frequentemente nas consultas.

Exemplos:

* slug;
* isbn;
* title;
* stock;
* is_active;
* status;
* tracking_code.

Objetivo:

* melhorar performance;
* facilitar buscas;
* otimizar filtros.

---

# Regras importantes

## Snapshot dos pedidos

Pedidos armazenam uma cópia dos dados no momento da compra.

São preservados:

* título do livro;
* preço pago;
* quantidade;
* endereço de entrega;
* destinatário;
* valores financeiros.

Alterações futuras no catálogo ou cadastro do usuário não modificam pedidos antigos.

---

# Integridade referencial

As relações utilizam Foreign Keys para garantir consistência dos dados.

Principais regras:

* Um livro pertence a uma editora.
* Um livro pode possuir vários autores.
* Um livro pode possuir várias categorias.
* Um livro pode possuir várias imagens.
* Um usuário pode possuir vários endereços.
* Um usuário possui um carrinho.
* Um carrinho possui vários itens.
* Um pedido pertence a um usuário.
* Um pedido possui vários itens.
* Um pedido possui um envio.
* Um livro pode possuir várias avaliações.
* Um usuário pode favoritar vários livros.
* Um envio controla rastreamento e entrega.

---

# Fluxo de dados

O ciclo principal do sistema segue:

```text
Migration

    ↓

Model

    ↓

Factory

    ↓

Seeder

    ↓

Banco populado

    ↓

Aplicação utilizando Eloquent
```

---

# Objetivo do banco

A estrutura foi planejada para:

* manter dados organizados;
* reduzir duplicação;
* preservar histórico de vendas;
* facilitar expansão do sistema;
* permitir novas funcionalidades;
* manter boas práticas de desenvolvimento.

Funcionalidades futuras previstas:

* cupons de desconto;
* histórico de alterações;
* avaliações com fotos;
* múltiplos endereços de entrega;
* integração com transportadoras;
* relatórios administrativos.

```
```
