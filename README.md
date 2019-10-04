# GUIDE
## Current versions:
* Laravel 6.0
* PHP Must be version 7.3 (or > 7.3)

## Environment:
* Setup DB
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_app
DB_USERNAME=user_app
DB_PASSWORD=pass_app
```

* Setup EMail (if you can not send email with your account gmail, let go to: https://myaccount.google.com/lesssecureapps and set it to ON).
```
MAIL_DRIVER=smtp
MAIL_FROM_ADDRESS=noreply@domain.com
MAIL_FROM_NAME=DomainName
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your.email@gmail.com
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls
```

## Docker: After setup docker finished:
```docker exec -it restfullbase-php-fpm bash ```
```composer global require "laravel/installer"```
```cd  RestfulCode/```
```composer update```
```chown -R www-data:www-data public/avatars```
```php artisan jwt:secret``` (if not yet install jwt, let do it: ```composer require tymon/jwt-auth "1.0.*"``` , and then: ```php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"``` )
==> after finished you will see in .env file like this: ```JWT_SECRET=XuWe37As7N9fUT67NyBMdQeNWgUl6dmVs7rJz8zOu1ZCbBak8hNPzjEA00CEj4h1```
```php artisan migrate``` (run this when you setup correct the connection of DB in .env file)


