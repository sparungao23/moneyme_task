# MoneyMe Loan Application

## Getting Started

### Prerequisites
- PHP
- Composer
- Mysql

### Installing
1. git clone https://github.com/sparungao23/moneyme_task.git
2. cd into project dir
3. cp .env.example .env
4. configure your .env environment 
```
APP_KEY=SECRET_32_STRING_KEY
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=YOUR_DATABASE
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD

SECRET_TOKEN=2690a62af98dc15105e6997399f89cdbf023b81a84b8659acd2acd9d40aa
```
5. Run `composer install`
6. Run `php artisan migrate`
7. Run `php artisan db:seed`
8. Please run both of this command for the application to work.
## Development
```
php artisan serve --port 8000 for the server
```
```
php artisan serve --port 8004` for the api
```
9. Run unit test 
```
vendor/bin/phpunit
```
10. Access the application URL
```
http://localhost:8000/third-party
```




