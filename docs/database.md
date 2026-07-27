# 🗄️ Database - Lume

Documentação da estrutura do banco de dados do **Lume**, um e-commerce de livros desenvolvido com Laravel.

O banco foi projetado priorizando:

- Normalização dos dados;
- Escalabilidade;
- Integridade referencial;
- Performance nas consultas;
- Facilidade de manutenção.

---

# Status

## ✅ Implementado

- Migrations
- Relacionamentos
- Models Eloquent

## 🚧 Em andamento

- Factories
- Seeders
- Enums

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
 │      └── order_items
 │
 ├── reviews
 │
 └── wishlists
```

---

# Administração

## admins

Armazena os usuários administrativos responsáveis pelo gerenciamento da plataforma.

### Relacionamentos

```text
Admin

Autenticação do painel administrativo
```

### Campos

| Campo | Tipo | Descrição |
|------|------|-----------|
| id | bigint | Identificador |
| name | string | Nome |
| email | string | E-mail |
| password | string | Senha criptografada |
| role | string | Cargo administrativo |
| is_active | boolean | Conta ativa |
| last_login_at | timestamp | Último acesso |
| created_at | timestamp | Data de criação |
| updated_at | timestamp | Data de atualização |
| deleted_at | timestamp | Soft Delete |

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

| Campo | Tipo | Descrição |
|------|------|-----------|
| id | bigint | Identificador |
| name | string | Nome |
| email | string | E-mail |
| email_verified_at | timestamp | E-mail verificado |
| password | string | Senha |
| is_active | boolean | Conta ativa |
| last_login_at | timestamp | Último login |
| remember_token | string | Token "Lembrar-me" |
| created_at | timestamp | Data de criação |
| updated_at | timestamp | Data de atualização |
| deleted_at | timestamp | Soft Delete |

---

# Catálogo

## authors

Armazena os autores cadastrados.

Um autor pode escrever vários livros.

### Relacionamentos

```text
Author

belongsToMany Books
```

### Campos

| Campo | Tipo | Descrição |
|------|------|-----------|
| id | bigint | Identificador |
| name | string | Nome |
| slug | string | URL amigável |
| biography | text | Biografia |
| photo | string | Foto |
| is_active | boolean | Status |

---

## publishers

Armazena as editoras.

Uma editora publica vários livros.

### Relacionamentos

```text
Publisher

hasMany Books
```

### Campos

| Campo | Tipo | Descrição |
|------|------|-----------|
| id | bigint | Identificador |
| name | string | Nome |
| slug | string | URL amigável |
| description | text | Descrição |
| website | string | Site oficial |
| logo | string | Logo |
| is_active | boolean | Status |

---

## categories

Categorias dos livros.

Suporta categorias e subcategorias.

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

| Campo | Tipo | Descrição |
|------|------|-----------|
| id | bigint | Identificador |
| name | string | Nome |
| slug | string | URL amigável |
| description | text | Descrição |
| parent_id | bigint | Categoria pai |
| is_active | boolean | Status |

---

## books

Tabela principal do catálogo.

Representa os livros vendidos pela loja.

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

| Campo | Tipo | Descrição |
|------|------|-----------|
| id | bigint | Identificador |
| title | string | Título |
| slug | string | URL amigável |
| isbn | string | ISBN |
| description | text | Descrição |
| synopsis | longText | Sinopse |
| price | decimal | Preço |
| sale_price | decimal | Preço promocional |
| stock | integer | Estoque |
| pages | integer | Número de páginas |
| language | string | Idioma |
| edition | string | Edição |
| format | string | Formato |
| publication_date | date | Data de publicação |
| weight | decimal | Peso |
| height | decimal | Altura |
| width | decimal | Largura |
| length | decimal | Comprimento |
| publisher_id | bigint | Editora |
| is_featured | boolean | Livro em destaque |
| is_active | boolean | Disponível |
| created_at | timestamp | Data de criação |
| updated_at | timestamp | Data de atualização |

---

## book_images

Armazena as imagens dos livros.

Um livro pode possuir diversas imagens.

### Relacionamentos

```text
BookImage

belongsTo Book
```

### Campos

| Campo | Tipo | Descrição |
|------|------|-----------|
| id | bigint | Identificador |
| book_id | bigint | Livro |
| image | string | Caminho da imagem |
| sort_order | integer | Ordem de exibição |
| is_primary | boolean | Define a capa principal |
| created_at | timestamp | Data de criação |
| updated_at | timestamp | Data de atualização |

---

## book_author

Tabela pivô responsável pelo relacionamento entre livros e autores.

### Relacionamentos

```text
Book

belongsToMany Authors

Author

belongsToMany Books
```

### Campos

| Campo | Tipo |
|------|------|
| book_id | bigint |
| author_id | bigint |

---

## book_category

Tabela pivô responsável pelo relacionamento entre livros e categorias.

### Relacionamentos

```text
Book

belongsToMany Categories

Category

belongsToMany Books
```

### Campos

| Campo | Tipo |
|------|------|
| book_id | bigint |
| category_id | bigint |

---

# Cliente

## addresses

Endereços cadastrados pelos clientes.

### Relacionamentos

```text
Address

belongsTo User
```

### Campos

| Campo | Tipo |
|------|------|
| id | bigint |
| user_id | bigint |
| label | string |
| recipient_name | string |
| phone | string |
| street | string |
| number | string |
| complement | string |
| neighborhood | string |
| city | string |
| state | string |
| cep | string |
| is_default | boolean |
| created_at | timestamp |
| updated_at | timestamp |

---

## carts

Carrinho de compras.

Cada usuário possui apenas um carrinho.

### Relacionamentos

```text
Cart

belongsTo User

hasMany CartItems
```

### Campos

| Campo | Tipo |
|------|------|
| id | bigint |
| user_id | bigint |
| created_at | timestamp |
| updated_at | timestamp |

---

## cart_items

Itens adicionados ao carrinho.

### Relacionamentos

```text
CartItem

belongsTo Cart

belongsTo Book
```

### Campos

| Campo | Tipo |
|------|------|
| id | bigint |
| cart_id | bigint |
| book_id | bigint |
| quantity | integer |
| created_at | timestamp |
| updated_at | timestamp |

---

# Vendas

## orders

Representa um pedido realizado pelo cliente.

A tabela mantém um **snapshot** das informações da compra.

### Relacionamentos

```text
Order

belongsTo User

hasMany OrderItems
```

### Campos

| Campo | Tipo |
|------|------|
| id | bigint |
| user_id | bigint |
| status | string |
| payment_status | string |
| subtotal | decimal |
| shipping | decimal |
| discount | decimal |
| total | decimal |
| recipient_name | string |
| phone | string |
| street | string |
| number | string |
| complement | string |
| neighborhood | string |
| city | string |
| state | string |
| cep | string |
| gateway | string |
| gateway_payment_id | string |
| paid_at | timestamp |
| created_at | timestamp |
| updated_at | timestamp |

---

## order_items

Itens pertencentes ao pedido.

Mantêm uma cópia das informações do livro no momento da compra.

### Relacionamentos

```text
OrderItem

belongsTo Order

belongsTo Book
```

### Campos

| Campo | Tipo |
|------|------|
| id | bigint |
| order_id | bigint |
| book_id | bigint |
| title | string |
| price | decimal |
| quantity | integer |
| created_at | timestamp |
| updated_at | timestamp |

---

# Interações

## reviews

Avaliações realizadas pelos clientes.

### Relacionamentos

```text
Review

belongsTo User

belongsTo Book
```

### Campos

| Campo | Tipo |
|------|------|
| id | bigint |
| user_id | bigint |
| book_id | bigint |
| rating | integer |
| comment | text |
| is_approved | boolean |
| created_at | timestamp |
| updated_at | timestamp |

---

## wishlists

Lista de desejos dos usuários.

Também representa um relacionamento Many-to-Many entre usuários e livros.

### Relacionamentos

```text
Wishlist

belongsTo User

belongsTo Book
```

### Campos

| Campo | Tipo |
|------|------|
| id | bigint |
| user_id | bigint |
| book_id | bigint |
| created_at | timestamp |
| updated_at | timestamp |

---

# Convenções

## Chaves primárias

Todas as tabelas utilizam:

- `id` (`bigint unsigned`)

Exceto a tabela `book_author`, que utiliza chave primária composta.

---

## Chaves estrangeiras

As Foreign Keys seguem o padrão do Laravel:

- user_id
- admin_id
- book_id
- author_id
- category_id
- publisher_id
- order_id
- cart_id

---

## Slugs

As entidades públicas utilizam slugs únicos.

Exemplo:

```text
/livros/clean-code

/autores/robert-c-martin

/categorias/programacao
```

---

## Timestamps

As tabelas utilizam:

- created_at
- updated_at

Quando necessário:

- deleted_at (Soft Deletes)

---

## Índices

Foram adicionados índices para melhorar a performance das consultas em campos frequentemente pesquisados, como:

- slug
- isbn
- title
- stock
- is_active
- sort_order

---

# Regras importantes

## Snapshot dos pedidos

Os pedidos armazenam uma cópia das informações da compra para preservar o histórico.

São armazenados:

- título do livro;
- preço pago;
- endereço de entrega;
- dados do destinatário;
- valores da compra.

Alterações futuras no catálogo ou nos dados do usuário não afetam pedidos já realizados.

---

## Soft Deletes

Utilizado em entidades onde o histórico deve ser preservado:

- admins
- users

Outras entidades poderão utilizar Soft Deletes futuramente, conforme a necessidade do projeto.

---

# Integridade referencial

Todas as relações utilizam Foreign Keys do Laravel.

Principais regras:

- Um livro pertence a uma editora.
- Um livro pode possuir vários autores.
- Um livro pode possuir várias categorias.
- Um livro pode possuir várias imagens.
- Um usuário pode possuir vários endereços.
- Um usuário possui um carrinho.
- Um carrinho possui vários itens.
- Um pedido pertence a um usuário.
- Um pedido possui vários itens.
- Um livro pode possuir várias avaliações.
- Um usuário pode favoritar vários livros.
