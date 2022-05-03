# Smart Teaching

Smart Teaching is an e-learning application that offers a personalised learning experience based on learner styles.

## Tech

- Laravel 9
- PHP 8.1.5

## Prerequisites

- Web server capable of serving PHP
- MariaDB database
- Composer

## Getting started with Smart Teaching

1. Install PHP dependencies
```
php composer install
```
2. Configure a virtual host in your development webserver, pointing to the '/public' directory within the fyp folder
```
DocumentRoot "/xampp/htdocs/fyp/public"
```
```
<Directory "/xampp/htdocs/fyp/public">
```
In this example I am using xampp to host locally

3. Migrate the tables and seed the data
```
php artisan migrate
```
Import sql file with name fyp-03-05-22.sql (This is due to the amount of data in the final application, seeding would be more time consuming)

4. Open the homepage and login using the following details
- User account: 
email: user@email.com  password: password
- Teacher account: 
email: teacher@email.com  password: password
- Admin account: 
email: admin@email.com  password: password






