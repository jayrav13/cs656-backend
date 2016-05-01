### CS656

To set up:
 - Create an copy of the .env.example file called .env and populate the below values:
```bash
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Use the below commands to easily install Composer, PHP's Dependency Manager:

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```
 - Execute `composer install` to install dependencies.
 - Execute `php artisan migrate` to create tables.
 - Execute `php artisan db:seed` to seed tables with sample data.
 - Execute `php artisan serve` to run server.
 
Consider executing the following cURL request to test that the server is working on Port 8000:

```bash
curl -i -X GET "http://localhost:8000/api/v0.1/heartbeat"

HTTP/1.1 200 OK
Date: Sun, 01 May 2016 22:29:14 GMT
Server: Apache/2.4.7 (Ubuntu)
X-Powered-By: PHP/5.5.9-1ubuntu4.14
Cache-Control: no-cache
Access-Control-Allow-Origin: *
Content-Length: 17
Content-Type: application/json

{"response":"OK"}
```
