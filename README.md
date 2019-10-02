# Headless-Laravel

Headless Laravel is the default Laravel framework combined with the Passport package. This togheter will be responsible for a flawless Rest-API application. All the good features of laravel and custom responses are coming together to give you the best possible experience.

## Installation

Here is a quick guide to install this application.
```
git clone git@github.com:Jeffrey-H/Headless-Laravel.git

composer install
php artisan passport:install
php artisan migrate
```

## Default Authentication URLs

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
