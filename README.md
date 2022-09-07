# Laravel Test
Simple web project with track user activity


1. Open terminal
2. In root folder ```docker-compose up -d --build```
3. ```cd src```
4. ``` cp .env.example .env ```
5. Open ```.env``` file
6. Change ```DB_HOST=mysql``` to ```DB_HOST=localhost```
```php
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
7. Run ```php artisan migrate```
8. Revert changes in ```.env```
9. Run in browser ```http://laravel-test/```
10. For login you have default user ```Admin``` with admin credentials. Password ```12345678```
