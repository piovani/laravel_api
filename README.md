# laravel_api
Esse projeto é um laboratório de testes.

## Comandos com Docker (Recomendado)
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


## O que o projeto está precisando

* Testes Unitários.

* Implementar o Swagger

* Sistema de E-Mail

* Sistema de Feriados para calculo de dias uteis.

* Integração com a api dos Correios para pesquisar o endereço atraves do CEP.
