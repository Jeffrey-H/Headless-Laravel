# Headless-Laravel

Headless Laravel is just the defdault Laravel framework combined with the Passport package. This togheter is responsible for a flaweless rest-api application. All the good stuff from laravel and some custom responses are comming toghether to give you the best experience.

## Installation

Here is a quick guide to install this application.
```
git clone git@github.com:Jeffrey-H/Headless-Laravel.git

composer install
php artisan passport:install
php artisan migrate
```

## Default Authentication url's

/oauth/register
Example request
```
{
    "name": "John Doe",
    "email": "JohnDoe@mail.com",
    "password": "password",
    "password_confirmation": "password"
}
```

/oauth/login
Example request
```
{
    "email": "JohnDoe@mail.com",
    "password": "password"
}
```
