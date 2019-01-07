# Dinas Pariwisata

### Dependencies
Before you can install this project smoothly, you must install :
- [Composer](https://getcomposer.org) (Latest)
- [NodeJS](https://nodejs.org) (LTS Version)

### How to install
Go to the project's root directory and type
```sh
$ composer update
$ npm install
$ cp .env.example .env
$ php artisan key:generate
```
Edit `.env` file. Read Laravel's [documentation](https://laravel.com/docs/5.7/configuration#environment-configuration) about environment variable and config the database and the app name
```env
APP_NAME="Dinas Pariwisata"
APP_ENV=local
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={DB Name}
DB_USERNAME={DB username} - root if you're using XAMPP
DB_PASSWORD={DB Password} - Leave it blank if you're using XAMPP
```
after that type
```sh
$ php artisan migrate --seed
```
and you're ready to go!

Enjoy!