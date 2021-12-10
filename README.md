## Nobi Investment
Aplikasi ini dibangun menggunakan Laravel versi 8

### Local Development
- php 8
- mysql 8

### Install

```bash
$ git clone https://github.com/budiyanto91/nobi-investment.git
```
- masuk ke direktori nobi-investment melalui terminal
- jalankan perintah

```bash
$ composer update
```
- copy file .env.example kemudaian rename file yg telah di copy menjadi .env
- buka file .env
- setting .env

> DB_DATABASE=nobi_investment 
> DB_USERNAME=mysql_user_name
> DB_PASSWORD=mysql_user_password

- buat database di mysql sesuai setting .env DB_DATABASE
- jalankan perintah

```bash
$ php artisan migrate
$ php artisan serve
```

### Testing
- import file NobiInvestment.postman_collection.json via postman