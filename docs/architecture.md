# 🏗️ Arquitetura - Lume

Documento responsável por descrever a arquitetura e organização do projeto **Lume**.

O objetivo é manter o sistema organizado, escalável e seguindo boas práticas de desenvolvimento utilizando Laravel.

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

* PHP 8.4+
* Laravel 12
* Eloquent ORM

## Banco de Dados

* MySQL / MariaDB

## Frontend

* Blade
* Tailwind CSS
* JavaScript
* Vite

## Ferramentas

* Composer
* NPM
* Git

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

Os Controllers são separados por contexto para manter responsabilidades bem definidas.

---

# Admin

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

* receber requisições;
* validar dados;
* chamar Actions ou Services;
* retornar Views ou Redirects.

---

# Store

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

* catálogo;
* busca;
* páginas públicas;
* carrinho;
* checkout.

---

# Customer

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

* perfil;
* endereços;
* pedidos;
* avaliações;
* lista de desejos.

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

* validar dados;
* normalizar informações;
* autorizar ações;
* centralizar mensagens de erro.

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

* executar uma única operação;
* facilitar reutilização;
* reduzir responsabilidades dos Controllers.

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

* coordenar múltiplas operações;
* integrar serviços externos;
* executar regras de negócio.

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

* tipagem;
* organização;
* menor acoplamento.

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
Shipment

Review
Wishlist
```

Responsabilidades:

* representar entidades;
* definir relacionamentos;
* casts;
* scopes;
* métodos auxiliares.

---

# Factories

Factories são utilizadas para criação de dados de teste e desenvolvimento.

Cada entidade possui uma Factory responsável por definir como registros fictícios serão gerados.

Exemplos:

```text
database/factories/

AdminFactory.php
UserFactory.php

AuthorFactory.php
PublisherFactory.php
CategoryFactory.php
BookFactory.php
BookImageFactory.php

AddressFactory.php

CartFactory.php
CartItemFactory.php

OrderFactory.php
OrderItemFactory.php
ShipmentFactory.php

ReviewFactory.php
WishlistFactory.php
```

Benefícios:

* testes automatizados;
* criação rápida de ambientes;
* dados consistentes;
* desenvolvimento mais eficiente.

---

# Seeders

Seeders controlam a criação dos dados iniciais do banco.

Responsabilidades:

* definir ordem de criação;
* criar dados relacionados;
* preparar ambientes de desenvolvimento.

Fluxo:

```text
Factory
    ↓
Seeder
    ↓
Banco populado
```

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

hasOne Shipment
```

---

# Enums

Valores fixos do sistema são representados utilizando PHP Enums.

Utilizados em:

```text
AdminRole.php

OrderStatus.php

PaymentStatus.php

PaymentMethod.php

ShipmentStatus.php

BookFormat.php

UserStatus.php
```

Benefícios:

* evita valores inválidos;
* reduz erros de digitação;
* melhora legibilidade;
* facilita manutenção.

---

# Policies

Policies controlam permissões e autorização.

Exemplos:

```text
BookPolicy

OrderPolicy

ReviewPolicy
```

Exemplos de regras:

* administradores podem gerenciar catálogo;
* clientes podem editar seus próprios dados;
* clientes visualizam apenas seus pedidos.

---

# Exceptions

Exceptions personalizadas representam erros específicos do domínio.

Exemplos:

```text
OutOfStockException

PaymentFailedException

BookUnavailableException
```

Benefícios:

* tratamento centralizado;
* mensagens mais claras;
* código organizado.

---

# Support

Classes auxiliares compartilhadas entre módulos.

Exemplos:

```text
SlugGenerator

PriceFormatter

IsbnFormatter
```

Responsabilidades:

* reutilização;
* evitar duplicação;
* funcionalidades auxiliares.

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

## Envios

```text
shipments
```

---

# Princípios adotados

## Separação de responsabilidades

Cada camada possui uma responsabilidade específica.

---

## Controllers enxutos

Controllers apenas coordenam o fluxo da aplicação.

---

## Reutilização

Evitar duplicação utilizando:

* Services;
* Actions;
* Support;
* DTOs.

---

## Camada de dados

O projeto utiliza:

* Eloquent ORM;
* Models;
* Migrations;
* Factories;
* Seeders;
* Enums.

Fluxo:

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
```

---

# Segurança

A aplicação utiliza:

* Form Requests;
* Policies;
* autenticação;
* autorização;
* proteção CSRF;
* Hash de senhas;
* Mass Assignment Protection;
* Eloquent ORM.

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

* facilitar manutenção;
* permitir crescimento do projeto;
* reduzir acoplamento;
* favorecer reutilização de código;
* simplificar testes;
* facilitar trabalho em equipe;
* seguir boas práticas recomendadas pelo Laravel.
