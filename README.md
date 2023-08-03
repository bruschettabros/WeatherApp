# Weather App

## Description

A simple weather app written in Laravel and react for demonstration purposes.

## Installation

1. Clone the repository
2. run `sail up -d`
3. Run `sail composer install`
4. Run `sail npm install`
5. Run `sail npm run dev`
6. Run `sail artisan migrate`
7. Run `sail php artisan db:seed` - This will generate a single user with a username of `test@example.com` and a
   password of `password`
8. Go to http://weatherapp.test/home and login

## testing

- Front end: `sail npm run test`
- Back end: `sail artisan test`