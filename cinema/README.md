# Cinema

## Première installation

```sh
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail npm run dev
```

## Installer la BDD

Remplacez <DB_DATABASE> par le nom de votre base de données dans votre .env
```sh
./vendor/bin/sail mysql -usail -ppassword -hmysql <DB_DATABASE> < ./database/cinema.sql
./vendor/bin/sail artisan migrate
```
