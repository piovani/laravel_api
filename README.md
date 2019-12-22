# laravel_api
This repository is a test lab.

<b>P.S.:</b> No need to have PHP or Composer installed, just Docker and Docker-Compose. Docker: 19.03.2, Docker-Compose: 1.21.0 or higher.

## Commands with Docker (Recommended)
```
docker-compose up -d
```

``` 
docker-compose run laravel-api bash
```

``` 
composer install
```

``` 
cp .env.example .env
```

```
php artisan migrate --seed
```

## Commands without Docker
``` 
composer install 
```

```
cp .env.example .env
```

```
php artisan migrate
```

```
php artisan db:seed
```

## Technologies Used
* Cors
* Faker BR
* Auditing
* Activitylog
* JWT Auth
* GraphQL

## Lista do que pode ser add ao projeto
* Intervention Image - https://github.com/intervention/image (tratamento de imagens)
* Horizon - https://github.com/laravel/horizon (Gerenciamento de filas de Jobs)
* Laravel Socialite - https://github.com/laravel/socialite (Autenticação com redes sociais)
* Laravel Activity Log - https://github.com/spatie/laravel-activitylog (Sistema de Log)
* Laravel Backup - https://github.com/spatie/laravel-backup (Backup arquivos do projeto e BD)
* Laravel Responsecache - https://github.com/spatie/laravel-responsecache (chace response, auta performace)
