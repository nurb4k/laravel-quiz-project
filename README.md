# [Laravel Quiz App by Nurbek Akmoldayev (@nurb4k. @nurb8k]
----------

# Getting started

## Installation

1. Clone the repository


2. Switch to the repo folder

    cd laravel-realworld-example-app

3. Install all the dependencies using composer

    composer install

4. Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

5. Generate a new application key

    php artisan key:generate

6. Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

7. Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:gothinkster/laravel-realworld-example-app.git
    cd laravel-realworld-example-app
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve


## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

