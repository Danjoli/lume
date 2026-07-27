# 🏗️ Arquitetura - Lume

Documento responsável por descrever a arquitetura e organização do projeto Lume.

O objetivo é manter o sistema organizado, escalável e seguindo boas práticas do Laravel.

---

# Visão Geral

O Lume é um e-commerce de livros desenvolvido utilizando Laravel.

A aplicação é dividida em camadas para separar responsabilidades:

```
Usuário
   |
   ↓
Routes
   |
   ↓
Controllers
   |
   ↓
Requests / Services
   |
   ↓
Models
   |
   ↓
Database
```

---

# Stack

## Backend

- PHP 8.3+
- Laravel 12
- Eloquent ORM

## Banco de Dados

- MySQL/MariaDB

## Frontend

- Blade
- Tailwind CSS
- JavaScript

## Ferramentas

- Composer
- NPM
- Vite
- Git

---

# Estrutura de Pastas

```
app/

├── Enums/
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
├── Services/
│
├── Observers/
│
└── Providers/
```

---

# Organização dos Controllers

Os Controllers são separados por contexto.

## Admin

Responsável pelo painel administrativo.

Exemplo:

```
Controllers/Admin/

BookController.php
AuthorController.php
OrderController.php
DashboardController.php
```

Responsabilidades:

- receber requisições;
- chamar Services;
- retornar respostas.

---

## Store

Responsável pela loja pública.

Exemplo:

```
Controllers/Store/

HomeController.php
BookController.php
CategoryController.php
CartController.php
```

Responsabilidades:

- catálogo;
- busca;
- páginas públicas;
- carrinho.

---

## Customer

Responsável pela área do cliente.

Exemplo:

```
Controllers/Customer/

ProfileController.php
OrderController.php
AddressController.php
```

Responsabilidades:

- perfil;
- pedidos;
- endereços.

---

# Form Requests

Toda validação de entrada deve ficar nos Form Requests.

Exemplo:

```
Http/Requests/

StoreBookRequest.php

UpdateBookRequest.php

CheckoutRequest.php
```

Responsabilidades:

- validar dados;
- normalizar informações;
- autorizar ações.

---

# Services

Services armazenam regras de negócio que não pertencem ao Controller.

Exemplo:

```
Services/

CartService.php

CheckoutService.php

PaymentService.php

ShippingService.php
```

Exemplo:

O Controller não deve calcular pedido:

```php
$total = $price * $quantity;
```

Essa regra pertence ao Service.

---

# Models

Models representam as entidades do sistema.

Principais Models:

```
Admin

User

Book

Author

Publisher

Category

Order

OrderItem

Cart

Review
```

Responsabilidades:

- relacionamentos;
- casts;
- scopes;
- regras simples da entidade.

---

# Relacionamentos Principais

## Livro

```
Book

belongsTo Publisher

belongsToMany Author

belongsToMany Category

hasMany Image

hasMany Review
```

---

## Usuário

```
User

hasMany Address

hasOne Cart

hasMany Order

hasMany Review

belongsToMany Book (Wishlist)
```

---

## Pedido

```
Order

belongsTo User

hasMany OrderItem
```

---

# Enums

Valores fixos devem utilizar Enums.

Exemplos:

```
Enums/

AdminRole.php

OrderStatus.php

PaymentStatus.php
```

Exemplo:

```php
enum OrderStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Shipped = 'shipped';
    case Delivered = 'delivered';
}
```

Benefícios:

- evita erros de digitação;
- melhora legibilidade;
- facilita manutenção.

---

# Policies

Policies controlam permissões.

Exemplo:

```
Policies/

BookPolicy.php

OrderPolicy.php
```

Exemplo:

Um administrador pode editar livros.

Um cliente só pode visualizar seus próprios pedidos.

---

# Observers

Observers serão utilizados quando uma ação automática precisar acontecer.

Exemplos:

```
Observers/

BookObserver.php
OrderObserver.php
```

Possíveis usos:

- gerar slug automaticamente;
- registrar alterações;
- executar ações após eventos.

---

# Banco de Dados

O banco foi dividido por módulos.

## Catálogo

```
authors

publishers

categories

books

book_images

book_author

book_category
```

---

## Cliente

```
users

addresses

carts

cart_items

wishlists

reviews
```

---

## Venda

```
orders

order_items
```

---

# Princípios utilizados

## Separação de responsabilidades

Cada parte do sistema possui uma responsabilidade clara.

---

## Controllers pequenos

Controllers devem coordenar o fluxo, não conter regras complexas.

---

## Código reutilizável

Evitar duplicação através de:

- Services;
- métodos reutilizáveis;
- componentes.

---

## Segurança

O projeto utiliza:

- validação via Requests;
- autenticação;
- autorização via Policies;
- proteção CSRF;
- Hash de senhas;
- controle de permissões.

---

# Fluxo de uma compra

```
Cliente

↓

Adicionar livro ao carrinho

↓

Checkout

↓

Validação

↓

Criação do pedido

↓

Pagamento

↓

Webhook

↓

Atualização do pedido

↓

Envio
```

---

# Objetivo da arquitetura

Manter o Lume preparado para crescer sem perder organização.

A arquitetura busca facilitar:

- manutenção;
- criação de novas funcionalidades;
- testes;
- escalabilidade;
- trabalho em equipe.
