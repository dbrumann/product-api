Product API
===========

This is a demo application for Symfony 4 & Flex showcasing an API for
interacting with a product catalog.

Installation
------------

 1. Clone the repository

    ```
    git clone git@github.com:dbrumann/product-api.git
    ```

 2. Install dependencies

    ```
    composer install
    ```

 3. Setup database

    I usually use SQLite for this. Please make sure you change your local `.env`
    file according to the comment in the `doctrine/doctrine-bundle` section.


    ```
    bin/console doctrine:schema:update --force
    bin/console doctrine:fixtures:load
    ```

 4. (Optional) Run a web server

    ```
    bin/console server:run
    ```
