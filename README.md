# 🗳️ Sistema de Votação Online (Back-End)

Sistema de enquetes com API RESTful e atualização em tempo real usando WebSockets.

## 🔧 Tecnologias

- PHP 8.4 + Laravel
- MySQL
- Redis (cache + filas)
- Laravel WebSockets (pusher replacement)
- Docker
- PHPUnit
- JWT Auth

## 🚀 Funcionalidades

- CRUD de enquetes e opções.
- Votação com restrição (IP ou token).
- Visualização de resultados em tempo real (WebSockets).
- Painel administrativo básico.
- Fila para processar votos.
- Autenticação de usuários.

## 📂 Estrutura do Projeto

Veja a pasta `app/`, `routes/`, e `database/` para entender a estrutura modular.

## 🐳 Como Rodar com Docker

```bash
git clone git@github.com:Ld36/votacao_online.git
cd votacao-online

cp .env.example .env
docker-compose up -d --build
docker exec -it app php artisan migrate --seed
