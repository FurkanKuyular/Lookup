## Description

This work has a CRUD process for person and address table. FE side using [Vue](https://vuejs.org) language installed with [Vite](https://vitejs.dev) in laravel

## Installation

After clone project you must to run ``` composer install ``` if you don't have composer package you may install from [here](https://getcomposer.org)

In this project used laravel sail if you have [Docker](https://www.docker.com) you can use laravel sail tricks :)

For Laravel Sail:

Open docker and run this command in project path ``` sail up ```

## Usage

You have to create your ``.env`` file or you can use direclty .env.example

After ``.env`` configuration you must to run ``sail artisan migrate`` and check your database

You can import postman collection for BE features if you dont have postman you can install [here](https://www.postman.com) 

And now for a last step you must to run ``sail npm run dev`` for FE.

## Notes

In FE side created CRUD process created just for person table and there may be validation errors on the FE side.

For vue design used [vuetify](https://vuetifyjs.com/en/)
