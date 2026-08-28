# Documentação técnica — Lume

Este diretório complementa o [README da raiz](../README.md). Enquanto o README apresenta instalação e operação básica, os documentos abaixo registram o desenho técnico e o estado do projeto.

## Guia de leitura

1. [Arquitetura](architecture.md): organização de camadas, rotas, views, assets, testes, segurança e publicação.
2. [Banco de dados](database.md): tabelas, relacionamentos, convenções, seeders e dados das integrações.
3. [Decisões técnicas](decisions.md): escolhas arquiteturais e seus motivos.
4. [Roadmap](roadmap.md): recursos concluídos, homologações externas pendentes e próximos passos.

## Manutenção da documentação

- Atualize a arquitetura ao alterar limites entre camadas, rotas, componentes, integrações ou práticas de segurança.
- Atualize o banco ao criar, alterar ou remover migrations, factories, seeders, enums persistidos ou relacionamentos.
- Registre em decisões escolhas duradouras que expliquem por que o projeto segue um determinado padrão.
- Atualize o roadmap quando uma entrega for concluída ou quando uma dependência externa mudar de estado.
- Não inclua credenciais, tokens, senhas, dados pessoais reais ou conteúdo integral de arquivos `.env`.

## Referências operacionais

- A configuração de ambiente está em [`.env.example`](../.env.example); valores reais pertencem somente ao `.env` do ambiente correspondente.
- Antes de publicar, revise a seção **Segurança e publicação** da [arquitetura](architecture.md#segurança-e-publicação).
- Para validar mudanças locais, execute `vendor/bin/pint --test` e `php artisan test`.
