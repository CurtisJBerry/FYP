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
Import sql file with name

## Running the tests

```
php artisan test
```

## Problems

If there are any problems at all, please contact me using my email:
```
curtis_j_berry@hotmail.com
```






