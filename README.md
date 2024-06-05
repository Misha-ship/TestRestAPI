# Comment API

This project is an API for comments. It is built using Laravel and uses MySQL for data storage.

## Installation

1. Enter the project:
    ```
    cd RestAPI
    ```
2. Build Docker Containers:
    ```
    docker-compose up -d --build
    ```
3. Enter the docker container:
    ```
    docker exec -it laravel_app bash
    ```
4. Install Composer dependencies:
    ```
    composer install
    ```
5. Run the database migrations:
    ```
    php artisan migrate
    ```
6. Start queue worker:
    ```
    php artisan queue:work
    ```
## Tests

To run the tests, execute the following command:

    php artisan test

### API collection for Postman

Import file with name **RestAPI.postman_collection.json** to Postman