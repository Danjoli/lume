# 📚 Lume

Lume é um e-commerce de livros desenvolvido com Laravel, focado em arquitetura organizada, boas práticas de desenvolvimento e escalabilidade.

O projeto está sendo construído como um sistema completo de livraria online, com o objetivo de aplicar conceitos profissionais de desenvolvimento web e servir como projeto de aprendizado e portfólio.

---

## 🚀 Tecnologias

* PHP 8.4+
* Laravel 12
* MySQL / MariaDB
* Blade
* Tailwind CSS
* Vite
* JavaScript
* Eloquent ORM

---

## ✨ Funcionalidades

### Área pública

* Catálogo de livros
* Busca de livros
* Filtro por categorias
* Navegação por autores
* Navegação por editoras
* Página de detalhes do livro
* Carrinho de compras
* Lista de desejos
* Avaliações de livros
* Cadastro de clientes
* Autenticação de usuários

---

### Área do cliente

* Gerenciamento de perfil
* Gerenciamento de endereços
* Histórico de pedidos
* Acompanhamento de compras
* Lista de desejos

---

### Painel administrativo

* Dashboard administrativo
* Gerenciamento de livros
* Gerenciamento de autores
* Gerenciamento de editoras
* Gerenciamento de categorias
* Gerenciamento de clientes
* Gerenciamento de pedidos
* Gerenciamento de administradores
* Controle de permissões

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

O sistema possui as seguintes entidades principais:

* Users
* Admins
* Books
* Authors
* Publishers
* Categories
* Book Images
* Addresses
* Carts
* Cart Items
* Orders
* Order Items
* Reviews
* Wishlists
* Shipments

O banco foi estruturado utilizando migrations do Laravel, seguindo boas práticas de relacionamento e organização de dados.

---

## 📖 Documentação

Toda a documentação do projeto está organizada na pasta `docs/`.

Arquivos principais:

* `architecture.md` → definição da arquitetura e organização do projeto
* `database.md` → documentação da estrutura do banco de dados
* `decisions.md` → registro das decisões técnicas tomadas durante o desenvolvimento
* `roadmap.md` → planejamento das próximas etapas e evolução do projeto

---

## 📌 Status do projeto

🚧 Em desenvolvimento.

### ✅ Concluído

* Estrutura inicial do projeto
* Definição da arquitetura
* Modelagem do banco de dados
* Criação das migrations
* Criação dos Models Eloquent
* Relacionamentos entre entidades
* Documentação inicial
* Enums
* Factories
* Testes das Factories
* Seeders
* População do banco de desenvolvimento
* Testes dos dados gerados
* Policies
* Observers
* Providers

### 🔄 Em andamento

* Form Requests
* Services

### 📋 Próximas etapas

* Actions
* Controllers
* Área administrativa
* Área pública
* Carrinho e checkout
* Integração de pagamentos
* Sistema de envio
* Testes automatizados

---

## 📄 Licença

Este projeto foi desenvolvido para fins de estudo, prática de desenvolvimento e composição de portfólio.
