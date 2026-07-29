# 🗺️ Roadmap - Lume

Roadmap de desenvolvimento do e-commerce de livros **Lume**.

O projeto será desenvolvido em etapas, priorizando uma base sólida, organização arquitetural e boas práticas antes da implementação das funcionalidades finais.

---

# Fase 1 — Fundação

## Planejamento

* [x] Definição do nome do projeto
* [x] Definição da stack
* [x] Definição da arquitetura
* [x] Modelagem inicial do banco de dados

## Documentação

* [x] README.md
* [x] architecture.md
* [x] database.md
* [x] decisions.md
* [x] roadmap.md

## Banco de Dados

* [x] Migration de admins
* [x] Migration de users
* [x] Migration de authors
* [x] Migration de publishers
* [x] Migration de categories
* [x] Migration de books
* [x] Migration de book_images
* [x] Migration de book_author
* [x] Migration de book_category
* [x] Migration de addresses
* [x] Migration de carts
* [x] Migration de cart_items
* [x] Migration de orders
* [x] Migration de order_items
* [x] Migration de reviews
* [x] Migration de wishlists
* [x] Migration de shipments

---

# Fase 2 — Estrutura Laravel

## Models

* [x] Admin
* [x] User
* [x] Author
* [x] Publisher
* [x] Category
* [x] Book
* [x] BookImage
* [x] Address
* [x] Cart
* [x] CartItem
* [x] Order
* [x] OrderItem
* [x] Review
* [x] Wishlist
* [x] Shipment

## Relacionamentos

* [x] Configuração dos relacionamentos Eloquent

## Estrutura da aplicação

* [x] Enums
* [x] Factories
* [x] Seeders
* [x] Policies
* [x] Observers
* [x] Providers
* [ ] Form Requests
* [ ] Services
* [ ] Actions
* [ ] DTOs
* [ ] Exceptions
* [ ] Support

---

# Fase 3 — Autenticação

## Cliente

* [ ] Cadastro
* [ ] Login
* [ ] Recuperação de senha
* [ ] Verificação de e-mail
* [ ] Perfil
* [ ] Alteração de senha
* [ ] Gerenciamento de endereços

## Administrador

* [ ] Login administrativo
* [ ] Middleware Admin
* [ ] Controle de permissões
* [ ] Controle de cargos

---

# Fase 4 — Painel Administrativo

## Dashboard

* [ ] Dashboard inicial
* [ ] Estatísticas
* [ ] Pedidos recentes
* [ ] Livros mais vendidos
* [ ] Livros com baixo estoque

## Catálogo

* [ ] CRUD de livros
* [ ] CRUD de autores
* [ ] CRUD de editoras
* [ ] CRUD de categorias
* [ ] Upload de imagens
* [ ] Controle de estoque

## Usuários

* [ ] Listagem de clientes
* [ ] Visualização de pedidos
* [ ] Gerenciamento de administradores

## Pedidos

* [ ] Listagem de pedidos
* [ ] Visualização de detalhes
* [ ] Atualização de status
* [ ] Gerenciamento de envio

---

# Fase 5 — Loja Pública

## Página inicial

* [ ] Banner principal
* [ ] Livros em destaque
* [ ] Novidades
* [ ] Categorias
* [ ] Editoras

## Catálogo

* [ ] Listagem de livros
* [ ] Busca
* [ ] Paginação
* [ ] Ordenação
* [ ] Filtros

## Página do livro

* [ ] Informações completas
* [ ] Galeria de imagens
* [ ] Autores
* [ ] Categorias
* [ ] Avaliações
* [ ] Livros relacionados

---

# Fase 6 — Carrinho e Checkout

## Carrinho

* [ ] Adicionar livros
* [ ] Remover livros
* [ ] Alterar quantidade
* [ ] Atualização automática

## Checkout

* [ ] Seleção de endereço
* [ ] Cálculo de frete
* [ ] Resumo da compra
* [ ] Criação do pedido

---

# Fase 7 — Pagamentos e Logística

## Pagamentos

* [ ] Integração com gateway
* [ ] PIX
* [ ] Cartão
* [ ] Boleto
* [ ] Webhooks
* [ ] Atualização automática do pedido

## Envio

* [ ] Integração com transportadora
* [ ] Geração de etiqueta
* [ ] Rastreamento
* [ ] Atualização de status do envio

---

# Fase 8 — Recursos do Cliente

* [ ] Lista de desejos
* [ ] Avaliações
* [ ] Histórico de pedidos
* [ ] Recompra
* [ ] Favoritos

---

# Fase 9 — Qualidade

## Segurança

* [ ] Validação de dados
* [ ] Policies
* [ ] Rate Limiting
* [ ] Auditoria

## Performance

* [ ] Cache
* [ ] Eager Loading
* [ ] Otimização de consultas
* [ ] Compressão de imagens

## SEO

* [ ] Sitemap
* [ ] Meta Tags
* [ ] Open Graph
* [ ] URLs amigáveis
* [ ] Dados estruturados

---

# Fase 10 — Testes

* [ ] Testes de Models
* [ ] Testes de Requests
* [ ] Testes de Services
* [ ] Testes de Controllers
* [ ] Testes do fluxo de compra
* [ ] Testes de integração

---

# Fase 11 — Deploy

* [ ] Configuração do servidor
* [ ] Ambiente de produção
* [ ] Banco de dados
* [ ] Build do frontend
* [ ] Filas
* [ ] Logs
* [ ] Monitoramento
* [ ] Backup

---

# Status Atual

## Concluído

* [x] Planejamento do projeto
* [x] Definição da arquitetura
* [x] Documentação inicial
* [x] Modelagem do banco de dados
* [x] Migrations
* [x] Models
* [x] Relacionamentos Eloquent
* [x] Enums
* [x] Factories
* [x] Seeders
* [x] Testes das Factories
* [x] Testes dos Seeders
* [x] Policies
* [x] Observers
* [x] Providers

## Em andamento

* [ ] Form Requests
* [ ] Services

## Próximo passo

➡️ Implementar a camada de regras de negócio da aplicação:

* Policies para controle de acesso
* Form Requests para validação
* Services e Actions para organização da lógica
