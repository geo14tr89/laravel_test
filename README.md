# Laravel Test
Simple web project with track user activity


1. Open terminal
2. In root folder ```docker-compose up -d --build```
3. ```cd src```
4. ``` cp .env.example .env ```
5. Generate app key ``` php artisan key:generate ```
6. Open ```.env``` file
7. Change ```DB_HOST=mysql``` to ```DB_HOST=localhost```
```php
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
8. Run ```php artisan migrate```
9. Revert changes in ```.env```
10. Run in browser ```http://laravel-test/```
11. For login you have default user ```Admin``` with admin credentials. Password ```12345678```
