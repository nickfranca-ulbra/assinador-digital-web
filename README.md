
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


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=assinador-digital-web
APP_URL=http://localhost:9001

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=assinador-digital-web
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Suba os containers do projeto
```sh
docker-compose up -d
```
Acessar o container
```sh
docker-compose exec assinador-digital-web bash
```

Instalar as dependências do projeto
```sh
composer install
```

Rodar as tabelas do banco
```sh
php artisan migrate
```

(Se necessário) Gerar a key do projeto Laravel
```sh
php artisan key:generate
```


Acessar o projeto
[http://localhost:9001](http://localhost:9001)

Acessar o banco de dados (use o acesso e senha definidos no .env)
[http://localhost:9002](http://localhost:9002)