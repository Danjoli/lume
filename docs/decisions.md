# 📋 Decisions - Lume

Registro das principais decisões técnicas e arquiteturais tomadas durante o desenvolvimento do projeto Lume.

O objetivo deste documento é manter o histórico das escolhas realizadas e seus motivos.

---

# 001 - Separação entre catálogo e vendas

## Decisão

Separar as entidades de catálogo das entidades de venda.

## Motivo

O catálogo possui informações permanentes dos produtos:

- livros;
- autores;
- categorias;
- editoras.

Enquanto vendas possuem informações históricas:

- pedidos;
- pagamentos;
- itens comprados.

Essa separação evita acoplamento entre módulos.

---

# 002 - Utilizar tabela book_images separada

## Decisão

As imagens dos livros serão armazenadas em uma tabela própria.

## Motivo

Inicialmente poderia existir apenas:

```
books.cover_image
```

Porém um livro pode precisar de:

- capa;
- contracapa;
- imagens adicionais;
- diferentes versões.

A tabela separada permite:

```
books

1:N

book_images
```

Benefícios:

- maior flexibilidade;
- galeria de imagens;
- controle de imagem principal;
- melhor organização.

---

# 003 - Usar relacionamento muitos-para-muitos entre livros e autores

## Decisão

Criar a tabela intermediária:

```
book_author
```

## Motivo

Um livro pode possuir:

- um autor;
- vários autores;
- organizadores;
- colaboradores.

Exemplo:

```
Livro

Clean Code

Autores:

Robert Martin
Outro colaborador
```

O relacionamento muitos-para-muitos evita limitações futuras.

---

# 004 - Categorias hierárquicas

## Decisão

Adicionar:

```
parent_id
```

na tabela categories.

## Motivo

Permitir categorias e subcategorias.

Exemplo:

```
Tecnologia

 ├── Programação

 ├── Banco de Dados

 └── Redes
```

Isso evita criar tabelas separadas para cada nível.

---

# 005 - Snapshot dos pedidos

## Decisão

Salvar informações do produto e endereço diretamente no pedido.

## Motivo

Pedidos representam eventos históricos.

Exemplo:

Um livro comprado hoje:

```
Clean Code
R$ 80,00
```

No futuro:

```
Clean Code
R$ 120,00
```

O pedido antigo deve continuar mostrando:

```
Clean Code
R$ 80,00
```

Por isso `order_items` salva:

- título;
- preço;
- quantidade.

E `orders` salva:

- endereço;
- destinatário;
- valores.

---

# 006 - Controllers pequenos

## Decisão

Evitar regras de negócio dentro dos Controllers.

## Motivo

Controllers devem apenas:

- receber requisição;
- validar entrada;
- chamar serviços;
- retornar resposta.

Exemplo:

Evitar:

```php
public function checkout()
{
    calcularFrete();
    validarEstoque();
    criarPedido();
    processarPagamento();
}
```

Preferir:

```php
CheckoutService->process();
```

Benefícios:

- código reutilizável;
- testes mais fáceis;
- manutenção melhor.

---

# 007 - Usar Form Requests

## Decisão

Centralizar validações usando Laravel Form Requests.

## Motivo

Evitar validações espalhadas nos Controllers.

Exemplo:

```
StoreBookRequest

UpdateBookRequest

CheckoutRequest
```

Benefícios:

- organização;
- mensagens personalizadas;
- código mais limpo.

---

# 008 - Utilizar Enums para estados

## Decisão

Estados fixos utilizarão Enums.

Exemplo:

```
OrderStatus

PaymentStatus

AdminRole
```

## Motivo

Evitar valores inconsistentes.

Antes:

```php
$status = "pagoo";
```

Problema:

Erro de digitação.

Depois:

```php
OrderStatus::PAID
```

Mais seguro e organizado.

---

# 009 - Soft Delete em entidades importantes

## Decisão

Utilizar Soft Delete quando o histórico for importante.

Exemplo:

```
admins
```

## Motivo

Não remover dados definitivamente.

Caso um administrador seja removido:

Antes:

```
DELETE FROM admins
```

Depois:

```
deleted_at = data
```

Permite:

- recuperação;
- auditoria;
- histórico.

---

# 010 - Separação entre Admin e Cliente

## Decisão

Administradores terão uma autenticação separada.

## Motivo

O painel administrativo possui regras diferentes da área do cliente.

Administrador:

- gerencia produtos;
- controla pedidos;
- acessa dados internos.

Cliente:

- compra;
- acompanha pedidos;
- gerencia perfil.

Separar evita problemas de permissão.

---

# 011 - Utilizar Services para regras complexas

## Decisão

Criar uma camada de Services.

Exemplos:

```
CheckoutService

PaymentService

ShippingService

CartService
```

## Motivo

Algumas regras não pertencem a Models ou Controllers.

Exemplo:

Checkout:

```
Carrinho

↓

Validar estoque

↓

Calcular valores

↓

Criar pedido

↓

Enviar pagamento
```

Essa lógica fica isolada.

---

# 012 - Banco preparado para crescimento

## Decisão

Criar uma estrutura mais completa desde o início.

## Motivo

Evitar refazer o banco quando novas funcionalidades surgirem.

Exemplos preparados:

- avaliações;
- lista de desejos;
- múltiplas imagens;
- múltiplos autores;
- categorias hierárquicas.

---

# Histórico de alterações

| Data | Decisão |
|---|---|
| 27/07/2026 | Estrutura inicial do banco criada |
| 27/07/2026 | Definição da arquitetura Laravel |
| 27/07/2026 | Separação dos módulos catálogo, cliente e vendas |
