# 🏗️ Arquitetura - Lume

Documento responsável por descrever a arquitetura e organização do projeto **Lume**.

O objetivo é manter o sistema organizado, escalável e seguindo as boas práticas do Laravel.

---

# Visão Geral

O Lume é um e-commerce de livros desenvolvido utilizando Laravel.

A aplicação é organizada em camadas, separando responsabilidades para facilitar manutenção, testes e evolução do sistema.

```text
Usuário
   │
   ▼
Routes
   │
   ▼
Controllers
   │
   ▼
Form Requests
   │
   ▼
Actions / Services
   │
   ▼
Models
   │
   ▼
Database
```

---

# Stack

## Backend

- PHP 8.3+
- Laravel 12
- Eloquent ORM

## Banco de Dados

- MySQL / MariaDB

## Frontend

- Blade
- Tailwind CSS
- JavaScript
- Vite

## Ferramentas

- Composer
- NPM
- Git

---

# Estrutura da aplicação

```text
app/

├── Actions/
├── DTOs/
├── Enums/
├── Exceptions/
│
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   ├── Customer/
│   │   └── Store/
│   │
│   ├── Requests/
│   │   ├── Admin/
│   │   ├── Customer/
│   │   └── Store/
│   │
│   └── Middleware/
│
├── Models/
│
├── Policies/
│
├── Providers/
│
├── Services/
│
└── Support/
```

---

# Organização dos Controllers

Os Controllers são separados por contexto.

## Admin

Responsável pelo painel administrativo.

Exemplos:

```text
DashboardController
BookController
AuthorController
PublisherController
CategoryController
OrderController
UserController
AdminController
```

Responsabilidades:

- receber requisições;
- validar entrada;
- chamar Actions ou Services;
- retornar Views ou Redirects.

---

## Store

Responsável pela loja pública.

Exemplos:

```text
HomeController
BookController
CategoryController
AuthorController
CartController
CheckoutController
```

Responsabilidades:

- catálogo;
- busca;
- páginas públicas;
- carrinho;
- checkout.

---

## Customer

Responsável pela área do cliente.

Exemplos:

```text
ProfileController
OrderController
AddressController
WishlistController
ReviewController
```

Responsabilidades:

- perfil;
- endereços;
- pedidos;
- avaliações;
- lista de desejos.

---

# Form Requests

Toda validação de entrada deve ser realizada utilizando Form Requests.

Exemplos:

```text
StoreBookRequest
UpdateBookRequest
CheckoutRequest
StoreReviewRequest
UpdateProfileRequest
```

Responsabilidades:

- validar dados;
- normalizar informações;
- autorizar ações;
- centralizar mensagens de erro.

---

# Actions

Actions representam operações específicas da aplicação.

Exemplos:

```text
CreateOrderAction

UpdateStockAction

CalculateShippingAction

UploadBookImageAction
```

Responsabilidades:

- executar uma única ação;
- facilitar reutilização;
- reduzir responsabilidades dos Controllers.

---

# Services

Services concentram regras de negócio mais complexas.

Exemplos:

```text
CheckoutService

CartService

PaymentService

ShippingService
```

Responsabilidades:

- coordenar múltiplas Actions;
- integrar serviços externos;
- executar regras de negócio.

---

# DTOs

DTOs (Data Transfer Objects) são utilizados para transportar dados entre camadas.

Exemplos:

```text
CheckoutData

AddressData

BookData
```

Benefícios:

- tipagem;
- organização;
- menor acoplamento.

---

# Models

Os Models representam as entidades do sistema.

Principais Models:

```text
Admin
User

Author
Publisher
Category
Book
BookImage

Address

Cart
CartItem

Order
OrderItem

Review
Wishlist
```

Responsabilidades:

- representar entidades;
- definir relacionamentos;
- casts;
- scopes;
- métodos auxiliares.

---

# Relacionamentos principais

## Book

```text
belongsTo Publisher

belongsToMany Authors

belongsToMany Categories

hasMany BookImages

hasMany Reviews

hasMany CartItems

hasMany OrderItems

hasMany Wishlists
```

---

## User

```text
hasMany Addresses

hasOne Cart

hasMany Orders

hasMany Reviews

belongsToMany Books (Wishlist)
```

---

## Order

```text
belongsTo User

hasMany OrderItems
```

---

# Enums

Valores fixos serão representados por Enums.

Exemplos:

```text
AdminRole

OrderStatus

PaymentStatus
```

Benefícios:

- evita erros de digitação;
- facilita manutenção;
- melhora a legibilidade.

---

# Policies

Policies controlam permissões da aplicação.

Exemplos:

```text
BookPolicy

OrderPolicy

ReviewPolicy
```

Exemplos de regras:

- administradores podem gerenciar o catálogo;
- clientes podem editar apenas seus próprios dados;
- clientes visualizam apenas seus pedidos.

---

# Exceptions

Exceptions personalizadas concentram erros específicos do domínio.

Exemplos:

```text
OutOfStockException

PaymentFailedException

BookUnavailableException
```

Benefícios:

- tratamento centralizado;
- mensagens mais claras;
- código mais organizado.

---

# Support

Classes auxiliares compartilhadas entre diferentes módulos.

Exemplos:

```text
SlugGenerator

PriceFormatter

IsbnFormatter
```

Responsabilidades:

- reutilização;
- evitar duplicação;
- utilitários da aplicação.

---

# Banco de Dados

O banco foi organizado por módulos.

## Administração

```text
admins
```

---

## Catálogo

```text
authors

publishers

categories

books

book_images

book_author

book_category
```

---

## Clientes

```text
users

addresses

carts

cart_items

wishlists

reviews
```

---

## Vendas

```text
orders

order_items
```

---

# Princípios adotados

## Separação de responsabilidades

Cada camada possui uma única responsabilidade.

---

## Controllers enxutos

Controllers apenas coordenam o fluxo da aplicação.

---

## Reutilização

Sempre que possível, evitar duplicação utilizando:

- Services;
- Actions;
- Support;
- DTOs.

---

## Arquitetura orientada ao domínio

As regras de negócio permanecem fora dos Controllers e Views.

---

## Segurança

A aplicação utiliza:

- Form Requests;
- Policies;
- autenticação;
- autorização;
- proteção CSRF;
- Hash de senhas;
- Mass Assignment Protection;
- Eloquent ORM.

---

# Fluxo de uma compra

```text
Cliente

      │
      ▼

Adicionar ao carrinho

      │
      ▼

Checkout

      │
      ▼

Form Request

      │
      ▼

CheckoutService

      │
      ▼

CreateOrderAction

      │
      ▼

PaymentService

      │
      ▼

Pedido criado

      │
      ▼

Pagamento confirmado

      │
      ▼

Atualização do pedido
```

---

# Objetivos da arquitetura

A arquitetura foi planejada para:

- facilitar manutenção;
- permitir crescimento do projeto;
- reduzir acoplamento;
- favorecer reutilização de código;
- simplificar testes;
- facilitar trabalho em equipe;
- seguir as boas práticas recomendadas pelo Laravel.
