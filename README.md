# API Todo list

## Descrição

Projeto full stack de um sistema completo de todo list, tanto frontend quanto backend e banco de dados. O sistema permite criar, listar, atualizar e deletar uma tarefa.

## Tecnologias

- Frontend
  - HTML
  - CSS
  - JavaScript
  - JQuery
  - AJAX
- Backend e Banco de dados
  - PHP 8.2.5
  - Phinx (para gerenciamento das migrations)
  - SQLite (para desenvolvimento)
  - MySQL (para "produção")

## Como inicializar o servidor

OBS. Certifique-se de ter o php 8.2.5 e o composer instalado.

Clone o repositório do github.

```shell
  git clone "https://github.com/dev-ribeiro/todo-list-system.git"
```

### Instale as dependências

Utilizo as seguintes dependências:

- Phinx.
- phpdotenv.

```shell
  composer install
```

### Execute as migrations

Para o ambiente de desenvolvimento

```shell
  composer migrate:dev
```

Para o ambiente de "produção"

```shell
  composer migrate:prod
```

### Configuração das variáveis de ambiente

Crie um arquivo .env na raiz do projeto. Pode copiar o arquivo .env.example para facilitar o processo.

Configure a variável PHP_ENV de acordo com ambiente que deseja:

Ambiente de "produção":

```env
  PHP_ENV = "production"
```

Ambiente de desenvolvimento (padrão):

```env
  PHP_ENV = "development"
```

### Inicie o servidor

OBS. Certifique-se de executar as migrations e configurar o PHP_ENV no mesmo ambiente que deseja inicializar o servidor, para evitar possíveis erros ao executar o servidor.

Após as migrations serem executadas e a variável de ambiente PHP_ENV configurada, inicialize o servidor com o seguinte comando:

```shell
  composer start
```

## Especificações técnicas

### Frontend

O frontend foi desenvolvido com o paradigma funcional. Nesse sentido, o servidor disponibiliza os arquivos estáticos dos assets de CSS e Javascript. Além disso, as chamadas AJAX estão no arquivo "api-adapter.js" para centralizar e facilitar o gerenciamento, através de Promises, para consumir os dados dos endpoints da API.

### Backend

O backend foi desenvolvido com o paradigma de orientação a objetos. Nesse sentido, a api utiliza o padrão de projeto MVC (model, view e controller).

### Banco de dados

O projeto utiliza dois bancos de dados, um para o ambiente de "produção" e outro para o ambiente de desenvolvimento. Nesse sentido, utilizo a biblioteca Phinx que facilita a escrita de migrations e facilita a configuração do banco de dados.

Para o ambiente de desenvolvimento utilizo o SQLite e para o ambiente de "produção" utilizo o MySQL.
