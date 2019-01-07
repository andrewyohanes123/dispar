# Dinas Pariwisata

### Dependencies
Before you can install this project smoothly, you must install :
- Composer (Latest)
- NodeJS (LTS Version)

### How to install
Go to the project's root directory and type
```sh
$ composer update
$ npm install
$ cp .env.example .env
$ php artisan key:generate
```
Edit `.env` file. Read Laravel's [documentation](https://laravel.com/docs/5.7/configuration#environment-configuration) about environment variable and config the database and the app name and after that type
```sh
$ php artisan migrate --seed
```
and you're ready to go!

Enjoy!