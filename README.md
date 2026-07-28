# 📚 Lume

Lume é um e-commerce de livros desenvolvido com Laravel, focado em arquitetura limpa, boas práticas e escalabilidade. O projeto está sendo construído como um sistema completo de livraria online, servindo tanto para aprendizado quanto para portfólio.

---

## 🚀 Tecnologias

- PHP 8.4+
- Laravel 12
- MySQL / MariaDB
- Blade
- Tailwind CSS
- Vite
- JavaScript
- Eloquent ORM

---

## ✨ Funcionalidades

### Área pública

- Catálogo de livros
- Busca de livros
- Categorias
- Autores
- Editoras
- Página do livro
- Carrinho de compras
- Lista de desejos
- Avaliações
- Cadastro de clientes
- Login

### Área do cliente

- Perfil
- Endereços
- Histórico de pedidos
- Lista de desejos

### Painel administrativo

- Dashboard
- Gerenciamento de livros
- Gerenciamento de autores
- Gerenciamento de editoras
- Gerenciamento de categorias
- Gerenciamento de clientes
- Gerenciamento de pedidos
- Gerenciamento de administradores

---

## 📂 Estrutura do projeto

```
app/
├── Actions/
├── DTOs/
├── Enums/
├── Exceptions/
├── Http/
├── Models/
├── Policies/
├── Services/
└── Support/

docs/
├── architecture.md
├── database.md
├── decisions.md
└── roadmap.md
```

---

## 🗄️ Banco de dados

O sistema possui entidades para:

- Users
- Admins
- Books
- Authors
- Publishers
- Categories
- Book Images
- Addresses
- Carts
- Cart Items
- Orders
- Order Items
- Reviews
- Wishlists
- Shipments

---

## 📖 Documentação

A documentação do projeto está organizada na pasta `docs/`.

- `architecture.md` → arquitetura da aplicação
- `database.md` → estrutura do banco de dados
- `decisions.md` → decisões técnicas do projeto
- `roadmap.md` → planejamento e progresso

---

## 📌 Status

🚧 Em desenvolvimento.

### Concluído

- Estrutura inicial
- Arquitetura do projeto
- Modelagem do banco de dados
- Migrations
- Models Eloquent
- Relacionamentos entre entidades
- Documentação inicial
- Enums
- Factories

### Próximas etapas

- Seeders
- Policies
- Form Requests
- Services
- Controllers
- Área administrativa
- Área pública
- Checkout
- Sistema de pagamentos
- Testes

---

## 📄 Licença

Este projeto foi desenvolvido para fins de estudo e portfólio.
