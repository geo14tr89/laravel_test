# Laravel Test
Simple web project with track user activity


1. Open terminal
2. In root folder ```docker-compose up -d --build```
3. ```cd src```
4. Open ```.env``` file
5. Change ```DB_HOST=mysql``` to ```DB_HOST=localhost```
```php
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
6. Run ```php artisan migrate```
7. Revert changes in ```.env```
8. Run in browser ```http://laravel-test/```
