# laravel_api
Esse repositorio e um laboratorio de testes.

<b>Obs:</b> não é necessário ter o PHP ou Composer instalados, apenas o Docker e Docker-Compose.

## Comandos com Docker (Recomendado)
```
docker-compose up -d
```

``` 
docker-compose run app bash
```

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
## Comandos sem Docker
<b>Obs:</b> é necessário ter o PHP, Composer e o Drive sqlite do PHP inslados e liberados em sua máquina.
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

## Lista do que pode ser add ao projeto
* Intervention Image - https://github.com/intervention/image (tratamento de imagens)
* Horizon - https://github.com/laravel/horizon (Gerenciamento de filas de Jobs)
* Laravel Socialite - https://github.com/laravel/socialite (Autenticação com redes sociais)
* Laravel Activity Log - https://github.com/spatie/laravel-activitylog (Sistema de Log)
* Laravel Backup - https://github.com/spatie/laravel-backup (Backup arquivos do projeto e BD)
* Laravel Responsecache - https://github.com/spatie/laravel-responsecache (chace response, auta performace)
