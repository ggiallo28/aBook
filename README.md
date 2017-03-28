## Address Book ##

### Prerequisites ###

* php 5.6.36
* enabled extension=php_openssl.dll, extension=php_mbstring.dll extension=php_pdo_sqlite.dll enabled in php.ini
* composer
* git

### Installation ###

* `git clone https://github.com/ggiallo28/aBook.git projectname`
* `cd projectname`
* `composer install`
* Create a database and inform *.env* or just rename file .env.example to .env
* `php artisan migrate` to create tables
* `php artisan db:seed` to populate tables
* `php -S localhost:8000 -t public` to run




