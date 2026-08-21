# Roadmap — Lume

Estado funcional do projeto em 21/08/2026. Uma funcionalidade marcada como concluída está implementada; isso não substitui homologação com credenciais reais ou testes de produção.

## Concluído

### Fundação e arquitetura

- [x] Laravel 12, Blade, Alpine.js, Tailwind CSS e Vite
- [x] Models, relacionamentos, enums, policies e observers
- [x] Form Requests, Services, Actions e objetos Data
- [x] Rotas separadas por área e domínio
- [x] Prefixos de rotas revisados, sem segmentos duplicados
- [x] Controllers, Form Requests e Services alinhados por domínio
- [x] Views organizadas entre componentes reutilizáveis e `_partials`
- [x] Factories e seeders com cenários relacionados
- [x] Cenários logísticos determinísticos para todos os status de envio

### Autenticação e conta

- [x] Cadastro, login e logout do cliente
- [x] Login e logout administrativo com guard próprio
- [x] Entrada `/admin` com encaminhamento automático para login ou dashboard
- [x] Recuperação e redefinição de senha nas duas áreas
- [x] Mensagens de validação em português e alertas de retorno
- [x] Perfil, senha, endereços, preferências e exclusão da conta
- [x] Histórico e acompanhamento de pedidos e envios

### Loja e administração

- [x] Home, catálogo, busca, filtros e paginação
- [x] URLs amigáveis por slug para o catálogo público
- [x] Galeria selecionável na página do livro
- [x] Busca, conta, carrinho e navegação no cabeçalho mobile
- [x] Livros, autores, editoras, categorias e imagens
- [x] Carrinho, cupons e lista de desejos
- [x] Avaliações de produtos com aprovação administrativa
- [x] Dashboard, relatórios, pedidos, clientes e administradores
- [x] Contato, newsletter, configurações e notificações

### Checkout, pagamentos e logística

- [x] Endereço, estoque, frete, desconto e resumo do checkout
- [x] Criação consistente de pedido e itens
- [x] Integração Asaas preparada para PIX, boleto e cartão
- [x] Retorno de pagamento e webhook autenticado
- [x] Integração Melhor Envio para cotação, compra e etiqueta
- [x] Webhook do Melhor Envio autenticado por HMAC-SHA256
- [x] Rastreamento e controle de status no painel e na conta
- [x] Central de envios no menu administrativo com preparação, compra, geração, impressão e transições logísticas
- [x] Variáveis sensíveis centralizadas no `.env`

## Pendente de homologação externa

- [ ] Validar pagamentos ponta a ponta com uma conta sandbox real do Asaas
- [ ] Configurar e validar o webhook público do Asaas
- [ ] Comprar e imprimir uma etiqueta no sandbox do Melhor Envio
- [ ] Validar rastreamento com eventos reais do Melhor Envio
- [ ] Configurar provedor real de e-mail e worker de fila persistente

## Qualidade e produção

- [x] Formatação do backend com Laravel Pint
- [x] Compilação das views e validação das rotas após a reorganização
- [x] Suíte atual: 34 testes e 95 assertions, incluindo painel de envios, seeders logísticos, webhook e URLs amigáveis
- [ ] Ampliar testes de integração do checkout e das chamadas externas de logística
- [ ] Cobrir regras críticas de estoque, cupons, reembolso e avaliações
- [ ] Adicionar rate limiting específico para login, contato e webhooks
- [ ] Configurar CI, monitoramento, backup e política de logs
- [ ] Revisar SEO técnico, acessibilidade e desempenho em produção

## Próximos passos recomendados

1. Homologar Asaas e Melhor Envio em sandbox com tokens próprios.
2. Criar testes automatizados dos fluxos financeiros e logísticos.
3. Configurar e-mail, filas e scheduler no ambiente de publicação.
4. Executar revisão de segurança e checklist de deploy.
