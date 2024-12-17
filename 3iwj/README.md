<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Installation de Laravel Breeze

```sh
./vendor/bin/sail composer require laravel/breeze --dev
./vendor/bin/sail artisan breeze:install
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

## Génération via artisan d'un model "Message" et sa migration

```sh
./vendor/bin/sail artisan make:model Message -m
```
