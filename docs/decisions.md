# 📋 Decisions - Lume

Registro das principais decisões técnicas e arquiteturais tomadas durante o desenvolvimento do projeto **Lume**.

Este documento serve como histórico das decisões de arquitetura, organização do código e modelagem do banco de dados.

---

# 001 - Separação entre catálogo e vendas

## Decisão

Separar as entidades de catálogo das entidades de venda.

## Motivo

O catálogo representa informações permanentes dos livros:

- livros;
- autores;
- categorias;
- editoras.

Já o módulo de vendas representa eventos históricos:

- pedidos;
- pagamentos;
- itens comprados.

Essa separação reduz o acoplamento entre os módulos e facilita futuras alterações.

---

# 002 - Utilizar tabela book_images

## Decisão

Armazenar as imagens dos livros em uma tabela própria.

## Motivo

Um livro pode possuir:

- capa;
- contracapa;
- imagens internas;
- outras imagens de divulgação.

A estrutura ficou:

```text
Book

1 : N

BookImages
```

Benefícios:

- múltiplas imagens;
- imagem principal;
- ordenação;
- maior flexibilidade.

---

# 003 - Relacionamento muitos-para-muitos entre livros e autores

## Decisão

Criar a tabela pivô `book_author`.

## Motivo

Um livro pode possuir:

- um autor;
- vários autores;
- organizadores;
- colaboradores.

Da mesma forma, um autor pode participar de diversos livros.

---

# 004 - Categorias hierárquicas

## Decisão

Adicionar o campo `parent_id` na tabela `categories`.

## Motivo

Permitir categorias e subcategorias.

Exemplo:

```text
Tecnologia
├── Programação
├── Banco de Dados
└── Redes
```

Isso evita criar tabelas separadas para cada nível.

---

# 005 - Snapshot dos pedidos

## Decisão

Salvar uma cópia dos dados da compra no momento da criação do pedido.

## Motivo

Pedidos representam um registro histórico.

Mesmo que o livro ou o endereço sejam alterados posteriormente, o pedido permanece exatamente como foi realizado.

São armazenados:

- título;
- preço;
- quantidade;
- endereço;
- destinatário;
- valores da compra.

---

# 006 - Controllers enxutos

## Decisão

Evitar regras de negócio dentro dos Controllers.

## Motivo

Os Controllers devem apenas:

- receber a requisição;
- validar os dados;
- chamar Services;
- retornar a resposta.

Toda lógica complexa deve ficar na camada de Services.

---

# 007 - Utilizar Form Requests

## Decisão

Centralizar todas as validações em Form Requests.

## Motivo

Evitar validações espalhadas pelos Controllers.

Benefícios:

- organização;
- reutilização;
- mensagens personalizadas;
- código mais limpo.

---

# 008 - Utilizar Enums

## Decisão

Utilizar PHP Enums para representar estados e tipos fixos do sistema.

## Exemplos

- AdminRole
- OrderStatus
- PaymentStatus
- ShipmentStatus

## Motivo

Evitar valores inválidos e erros de digitação.

---

# 009 - Utilizar Soft Deletes

## Decisão

Utilizar Soft Deletes nas entidades onde o histórico é importante.

## Aplicado em

- Admins
- Users

## Motivo

Permitir:

- recuperação de registros;
- auditoria;
- preservação do histórico.

---

# 010 - Separação entre Administradores e Clientes

## Decisão

Utilizar autenticações independentes.

## Motivo

Administradores possuem responsabilidades diferentes dos clientes.

Administração:

- gerencia catálogo;
- gerencia pedidos;
- administra usuários.

Clientes:

- realizam compras;
- acompanham pedidos;
- gerenciam o próprio perfil.

---

# 011 - Camada de Services

## Decisão

Centralizar regras de negócio em Services.

## Exemplos

- CheckoutService
- CartService
- PaymentService
- ShippingService

## Motivo

Facilitar manutenção, testes e reutilização.

---

# 012 - Banco preparado para crescimento

## Decisão

Projetar o banco de dados pensando em futuras funcionalidades.

## Funcionalidades previstas

- avaliações;
- lista de desejos;
- múltiplas imagens;
- múltiplos autores;
- categorias hierárquicas.

---

# 013 - Utilizar Slugs

## Decisão

Todas as entidades públicas utilizarão slugs únicos.

## Aplicado em

- Books
- Authors
- Categories
- Publishers

## Motivo

URLs amigáveis, melhor SEO e facilidade de navegação.

Exemplo:

```text
/livros/clean-code

/autores/robert-c-martin
```

---

# 014 - Organização por responsabilidade

## Decisão

Organizar a aplicação em camadas.

## Estrutura

```text
Controllers
    ↓
Form Requests
    ↓
Services
    ↓
Models
    ↓
Database
```

## Motivo

Separar responsabilidades e facilitar a manutenção do projeto.

---

# 015 - Documentação do projeto

## Decisão

Manter toda a documentação técnica na pasta `docs/`.

## Arquivos

- architecture.md
- database.md
- roadmap.md
- decisions.md

## Motivo

Centralizar a documentação e facilitar o entendimento do projeto.

---

# 015 - Separar controle de entrega em Shipment

## Decisão

Criar uma entidade própria para envio dos pedidos.

## Motivo

Pedido e logística possuem responsabilidades diferentes.

## Pedido:

- compra;
- pagamento;
- valores.

## Shipment:

- transportadora;
- rastreamento;
- entrega.

## Relacionamento:

- Order
- hasOne Shipment

## Benefícios:

- integração com transportadoras;
- controle de rastreio;
- evolução futura.

---

# 016 - Utilizar Factories para geração de dados

## Decisão

Criar uma Factory para cada entidade principal do sistema.

## Motivo

Separar a lógica de criação de dados dos Seeders.

Factories ficam responsáveis por definir como um registro é criado, enquanto Seeders definem quais dados serão inseridos.

Benefícios:

- testes mais simples;
- criação rápida de ambientes;
- dados consistentes;
- melhor organização.

Exemplos:

UserFactory

BookFactory

OrderFactory

ShipmentFactory

---

# Histórico de decisões

| Data | Alteração |
|------|-----------|
| 27/07/2026 | Estrutura inicial do banco de dados definida |
| 27/07/2026 | Arquitetura Laravel definida |
| 27/07/2026 | Separação dos módulos catálogo, cliente e vendas |
| 28/07/2026 | Implementação dos Models, Enums e Factories |
| 28/07/2026 | Definição da criação de dados de teste utilizando Factories |
