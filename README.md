
### Passo a passo
Clone Repositório utilizando UBUNTU 24.04.1 LTS

```sh
git clone https://github.com/nickfranca-ulbra/assinador-digital-web.git
```

```sh
cd assinador-digital-web/
```


Crie o Arquivo .env
```sh
cp .env.example .env
```
```sh
code .
```


Dentro do código do projeto atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=assinador-digital-web
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=assinador-digital-web
DB_USERNAME=
DB_PASSWORD=

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

```
No Dockerfile, troque para o seu user

```dosini
ARG user=
ARG uid=1000
```

Suba os containers do projeto
```sh
docker compose up -d
```
Acessar o container
```sh
docker compose exec assinador-digital-web bash
```

Instalar as dependências do projeto
```sh
composer install
```
(Se necessário) Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Rodar as tabelas do banco
```sh
php artisan migrate
```


Acessar o projeto
[http://localhost:9001](http://localhost:9001)

Acessar o banco de dados (use o acesso e senha definidos no .env)
[http://localhost:9002](http://localhost:9002)