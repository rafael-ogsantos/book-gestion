# Yii2 API Project 

## Overview

Esse projeto é uma API RESTful desenvoljsonvida em Yii2 Framework. A API é responsável por gerenciar clientes e livros.

## Instalação

1. Clone o repositório

```bash
git clone git@github.com:rafael-ogsantos/book-gestion.git
```

2. Instale as dependências

```bash
composer install
```

## Migrações

Execute o comando abaixo para criar as tabelas no banco de dados

```bash
php yii migrate
```

## endpoints

### Clientes

- GET /clients
- POST /clients

### Livros

- GET /books
- POST /books


## Criar usuários

Para criar um usuário, execute o comando abaixo

```bash
php yii user/create batman123 1234 bruce
```