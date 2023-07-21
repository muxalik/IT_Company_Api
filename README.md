<h1 align="center">IT Company API</h1>

![db](https://github.com/muxalik/IT_Company_Api/blob/master/public/database.jpg)

## About

Laravel REST API server for projects and employees management

## Requirements

Package | Version
--- | ---
[Composer](https://getcomposer.org/)  | V2.2.5+
[Php](https://www.php.net/)  | V8.0.2+
[Mysql](https://www.mysql.com/)  |V5.7+

<a name="installation"></a>
## Installation

> **Warning**
>   Make sure to follow the requirements first.

Here is how you can run the project locally:
1. Clone this repo
    ```sh
    git clone https://github.com/muxalik/IT_Company_Api.git
    ```

1. Go into the project root directory
    ```sh
    cd IT_Company_Api
    ```

1. Copy .env.example file to .env file
    ```sh
    cp .env.example .env
    ```
1. Create database `itcompany` (you can change database name)

1. Go to `.env` file 
    - set database credentials (`DB_DATABASE=itcompany`, `DB_USERNAME=root`, `DB_PASSWORD=root`)
    - Make sure to follow your database username and password

1. Install PHP dependencies 
    ```sh
    composer install
    ```

1. Generate key 
    ```sh
    php artisan key:generate
    ```

1. Run migrations and seeders
    ```
    php artisan migrate --seed
    ```

1. Run server 
    ```sh
    php artisan serve
    ```  

1. Consume the api!     