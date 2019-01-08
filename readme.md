
# Laravel 5 with MongoDB & Passport #

Sample Laravel project with mongodb & passport support 

## Installation ##

* `git clone git@github.com:jayant1993/sample-laravel-mongo-passport-project.git projectname`
* `cd projectname`
* `composer install`
* `php artisan key:generate`
* Create .env file from .env.example
* Create a database and inform *.env*
* `php artisan serve` to start the app on http://localhost:8000/

Another way to install it is to download and upload [this package](https://github.com/jayant1993/sample-laravel-mongo-passport-project/archive/master.zip), unpack it in your server folder, and just launch it and follow the above installation process.

## API's ##

### Create user ###
`hppt://localhost:8000/api/user/add`

### Login user ###
`http://localhost:8000/api/user/login`

### Refresh token ###
`http://localhost:8000/api/user/refresh`

## Packages included ##

* moloquent/moloquent
* laravel/passport


