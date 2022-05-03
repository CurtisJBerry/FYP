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

3. Create a user and database with same name and all permissions
- Username: fyp
- Password: mypassword
- Database name: fyp

4. Migrate the tables and seed the data
```
php artisan migrate
```
Import sql file with name fyp-03-05-22.sql (This is due to the amount of data in the final application, seeding would be more time consuming)

5. Open the homepage and login using the following details
- User account: 
email: user@email.com  password: password
- Teacher account: 
email: teacher@email.com  password: password
- Admin account: 
email: admin@email.com  password: password

6. Use the features for each account, there is seed data to show how the data analysis function works




