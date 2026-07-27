# Lume 📚

E-commerce de livros desenvolvido com Laravel.

O Lume tem como objetivo criar uma plataforma moderna de venda de livros online, com catálogo completo, gerenciamento administrativo, carrinho de compras, checkout e integração com pagamentos.

---

# 🚀 Tecnologias utilizadas

## Backend

- PHP 8.3+
- Laravel 12
- Eloquent ORM
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

# 📌 Funcionalidades

## Loja

- [ ] Página inicial
- [ ] Catálogo de livros
- [ ] Busca de livros
- [ ] Filtros por categoria, autor e editora
- [ ] Página de detalhes do livro
- [ ] Sistema de avaliações
- [ ] Lista de desejos

---

## Cliente

- [ ] Cadastro de usuário
- [ ] Login
- [ ] Gerenciamento de perfil
- [ ] Gerenciamento de endereços
- [ ] Histórico de pedidos
- [ ] Acompanhamento de pedidos

---

## Carrinho e pedidos

- [ ] Carrinho de compras
- [ ] Controle de estoque
- [ ] Checkout
- [ ] Cálculo de frete
- [ ] Criação de pedidos
- [ ] Histórico de compras

---

## Pagamentos

- [ ] Integração com gateway de pagamento
- [ ] PIX
- [ ] Cartão
- [ ] Boleto
- [ ] Webhooks de atualização de pagamento

---

## Administração

- [ ] Login administrativo
- [ ] Dashboard
- [ ] Gerenciamento de livros
- [ ] Gerenciamento de autores
- [ ] Gerenciamento de editoras
- [ ] Gerenciamento de categorias
- [ ] Gerenciamento de pedidos
- [ ] Gerenciamento de clientes

---

# 🗄️ Estrutura do Banco de Dados

Principais entidades:

```
admins

users

authors

publishers

categories

books

book_images

book_author

book_category

addresses

carts

cart_items

orders

order_items

reviews

wishlists
```

---

# 📚 Catálogo

O sistema possui uma estrutura flexível para livros:

- Um livro pode possuir vários autores.
- Um livro pode possuir várias categorias.
- Um livro pode possuir várias imagens.
- Uma editora pode possuir vários livros.

Exemplo:

```
Book
 |
 ├── Publisher
 |
 ├── Authors
 |
 ├── Categories
 |
 └── Images
```

---

# 🏗️ Arquitetura

O projeto segue uma organização baseada nas boas práticas do Laravel:

```
app/

├── Models
├── Http
│   ├── Controllers
│   ├── Requests
│   └── Middleware
│
├── Services
├── Policies
├── Enums
└── Observers
```

Princípios utilizados:

- Controllers enxutos
- Form Requests para validação
- Services para regras de negócio
- Policies para autorização
- Enums para estados fixos
- Eloquent Relationships

---

# ⚙️ Instalação

Clone o projeto:

```bash
git clone https://github.com/seu-usuario/lume.git
```

Entre na pasta:

```bash
cd lume
```

Instale as dependências PHP:

```bash
composer install
```

Instale as dependências frontend:

```bash
npm install
```

Crie o arquivo de ambiente:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

Configure o banco de dados no arquivo:

```
.env
```

Execute as migrations:

```bash
php artisan migrate
```

Compile os assets:

```bash
npm run build
```

Inicie o servidor:

```bash
php artisan serve
```

---

# 🧪 Desenvolvimento

Durante o desenvolvimento:

Terminal PHP:

```bash
php artisan serve
```

Terminal Vite:

```bash
npm run dev
```

---

# 📂 Documentação

Documentações técnicas:

```
docs/

├── database.md
├── architecture.md
├── roadmap.md
└── decisions.md
```

---

# 📝 Roadmap

## Fundação

✅ Planejamento

✅ Modelagem do banco

✅ Migrations


## Próximas etapas

⬜ Models

⬜ Relacionamentos Eloquent

⬜ Factories

⬜ Seeders

⬜ Autenticação

⬜ Painel administrativo

⬜ Loja pública

⬜ Carrinho

⬜ Checkout

⬜ Pagamentos

⬜ Deploy


---

# 👨‍💻 Desenvolvedor

Projeto desenvolvido por Danilo Fiod.

---

# 📄 Licença

Este projeto é desenvolvido para fins de estudo, portfólio e aprendizado.
