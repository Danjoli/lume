# 🗄️ Database - Lume

Documentação da estrutura do banco de dados do e-commerce Lume.

O banco foi projetado pensando em flexibilidade, escalabilidade e separação de responsabilidades.

---

# Diagrama geral

```
                    publishers
                         |
                         |
                       books
                    /    |    \
                   /     |     \
                  /      |      \
             authors  categories book_images
                  \      /
                   \    /
              book_author
              book_category


users
 |
 ├── addresses
 |
 ├── carts
 |      |
 |      └── cart_items
 |
 ├── orders
 |      |
 |      └── order_items
 |
 ├── reviews
 |
 └── wishlists
```

---

# Administração

## admins

Tabela responsável pelos usuários administrativos do sistema.

Utilizada para acesso ao painel administrativo.

## Campos

| Campo | Tipo | Descrição |
|---|---|---|
| id | bigint | Identificador |
| name | string | Nome do administrador |
| email | string | E-mail de acesso |
| password | string | Senha criptografada |
| role | string | Nível de acesso |
| is_active | boolean | Controle de acesso |
| last_login_at | timestamp | Último login |
| created_at | timestamp | Data criação |
| updated_at | timestamp | Data atualização |
| deleted_at | timestamp | Soft delete |

---

# Catálogo

## authors

Armazena os autores dos livros.

Um autor pode possuir vários livros.

Relacionamento:

```
Author

hasMany Books
```

Campos:

| Campo | Tipo | Descrição |
|-|-|-|
| id | bigint | Identificador |
| name | string | Nome |
| slug | string | URL amigável |
| biography | text | Biografia |
| photo | string | Foto |
| is_active | boolean | Status |

---

## publishers

Armazena editoras.

Uma editora pode possuir vários livros.

Relacionamento:

```
Publisher

hasMany Books
```

Campos:

| Campo | Tipo | Descrição |
|-|-|-|
| id | bigint | Identificador |
| name | string | Nome |
| slug | string | URL amigável |
| description | text | Descrição |
| website | string | Site |
| logo | string | Logo |

---

## categories

Categorias dos livros.

Possui suporte para categorias e subcategorias.

Exemplo:

```
Tecnologia

 ├── Programação

 ├── Banco de Dados

 └── Redes
```

Relacionamento:

```
Category

hasMany Books

belongsTo Category (parent)
```

Campos:

| Campo | Tipo | Descrição |
|-|-|-|
| id | bigint | Identificador |
| name | string | Nome |
| slug | string | URL amigável |
| description | text | Descrição |
| parent_id | bigint | Categoria pai |

---

## books

Tabela principal do catálogo.

Representa os livros disponíveis na loja.

Relacionamentos:

```
Book

belongsTo Publisher

belongsToMany Authors

belongsToMany Categories

hasMany Images

hasMany Reviews
```

Campos:

| Campo | Tipo | Descrição |
|-|-|-|
| id | bigint | Identificador |
| title | string | Título |
| slug | string | URL amigável |
| isbn | string | Código ISBN |
| description | text | Descrição curta |
| synopsis | longText | Sinopse |
| price | decimal | Preço |
| sale_price | decimal | Preço promocional |
| stock | integer | Estoque |
| pages | integer | Número de páginas |
| language | string | Idioma |
| edition | string | Edição |
| format | string | Formato |
| publication_date | date | Data publicação |
| weight | decimal | Peso |
| height | decimal | Altura |
| width | decimal | Largura |
| length | decimal | Comprimento |
| publisher_id | bigint | Editora |
| is_featured | boolean | Destaque |
| is_active | boolean | Disponível |

---

## book_images

Armazena imagens dos livros.

Um livro pode ter várias imagens.

Exemplo:

```
Livro

├── capa.jpg

├── verso.jpg

└── detalhes.jpg
```

Relacionamento:

```
Book

hasMany BookImages
```

Campos:

| Campo | Tipo | Descrição |
|-|-|-|
| id | bigint | Identificador |
| book_id | bigint | Livro |
| image | string | Caminho da imagem |
| sort_order | integer | Ordem |
| is_primary | boolean | Imagem principal |

---

## book_author

Tabela intermediária entre livros e autores.

Relacionamento:

```
Book belongsToMany Author

Author belongsToMany Book
```

Campos:

| Campo | Tipo |
|-|-|
| book_id | bigint |
| author_id | bigint |

---

## book_category

Tabela intermediária entre livros e categorias.

Relacionamento:

```
Book belongsToMany Category

Category belongsToMany Book
```

Campos:

| Campo | Tipo |
|-|-|
| book_id | bigint |
| category_id | bigint |

---

# Cliente

## addresses

Endereços dos usuários.

Um usuário pode ter vários endereços.

Relacionamento:

```
User

hasMany Addresses
```

Campos:

| Campo | Tipo |
|-|-|
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

---

## carts

Carrinho do usuário.

Relacionamento:

```
User

hasOne Cart
```

Campos:

| Campo | Tipo |
|-|-|
| id | bigint |
| user_id | bigint |

---

## cart_items

Produtos dentro do carrinho.

Relacionamento:

```
Cart

hasMany CartItems
```

Campos:

| Campo | Tipo |
|-|-|
| cart_id | bigint |
| book_id | bigint |
| quantity | integer |

---

# Vendas

## orders

Representa os pedidos realizados.

Possui um snapshot dos dados da compra.

Isso garante que alterações futuras no usuário ou endereço não alterem pedidos antigos.

Relacionamentos:

```
Order

belongsTo User

hasMany OrderItems
```

Campos:

| Campo | Tipo |
|-|-|
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

---

## order_items

Itens comprados no pedido.

Mantém uma cópia das informações do livro no momento da compra.

Exemplo:

```
Livro custava R$ 49,90

Depois aumentou para R$ 69,90

O pedido antigo continua R$ 49,90
```

Campos:

| Campo | Tipo |
|-|-|
| order_id | bigint |
| book_id | bigint |
| title | string |
| price | decimal |
| quantity | integer |

---

# Interações

## reviews

Avaliações dos livros.

Relacionamentos:

```
User

hasMany Reviews


Book

hasMany Reviews
```

Campos:

| Campo | Tipo |
|-|-|
| user_id | bigint |
| book_id | bigint |
| rating | integer |
| comment | text |
| is_approved | boolean |

---

## wishlists

Lista de desejos.

Relacionamento:

```
User belongsToMany Books

Book belongsToMany Users
```

Campos:

| Campo | Tipo |
|-|-|
| user_id | bigint |
| book_id | bigint |

---

# Regras importantes

## Snapshot de pedidos

Pedidos não dependem dos dados atuais do catálogo.

São armazenados:

- nome do livro;
- preço;
- endereço;
- valores da compra.

---

## Slugs

Entidades públicas utilizam slug:

Exemplo:

```
/livro/clean-code

/autor/robert-martin

/categoria/programacao
```

---

## Soft Delete

Utilizado em entidades onde histórico é importante:

- admins;
- futuramente livros e usuários.

---

# Próximas etapas

Após finalizar as migrations:

1. Criar Models.
2. Configurar relacionamentos Eloquent.
3. Criar Factories.
4. Criar Seeders.
5. Testar a estrutura do banco.
