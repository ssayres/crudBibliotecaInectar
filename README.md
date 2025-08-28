## Biblioteca Laravel (com Docker)

Projeto Laravel para controle de livros, usando Docker, MySQL e Laravel

## Requisitos

- Docker >= 24.x  
- Docker Compose >= 2.x  
- Git

## Passo a passo

1 - docker-compose up -d --build

Isso criará os containers:

biblioteca_app → PHP + Laravel

biblioteca_db → MySQL

biblioteca_phpmyadmin → PhpMyAdmin (opcional)

2 - docker exec -it biblioteca_app bash & composer install
pra entrar no container do laravel e instalar o composer caso tenha uma falha na build

3 - php artisan migrate
vai criar as tabelas necessárias


## Adendos
A ideia da tabela empréstimos não foi utilizada
foram adicionados testes unitários simples que podem ser testados utilizando docker exec -it biblioteca_app bash - > php artisan test --filter=LivroCrudTest
não foi adicionado um sistema de login, mas caso haja algum problema com session o comando php artisan key:generate resolverá


