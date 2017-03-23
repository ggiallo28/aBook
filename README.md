## Address Book ##

### Prerequisites ###

* php 5.6.36
* composer
* git

### Installation ###

* `git clone https://github.com/ggiallo28/aBook.git projectname`
* `cd projectname`
*  enabled extension=php_openssl.dll, extension=php_mbstring.dll extension=php_pdo_sqlite.dll enabled in php.ini
* `composer install`
* Create a database and inform *.env*
* `php artisan migrate` to create tables
* `php artisan db:seed` to populate tables
* `php -S localhost:8000 -t public` to run




