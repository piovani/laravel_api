# laravel_api
Esse repositorio e um laboratorio de testes.

Comandos com Docker (Recomendado)

<b>Obs:</b> não é necessário ter o PHP ou Composer instalados, apenas o Docker e Docker-Compose.
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
