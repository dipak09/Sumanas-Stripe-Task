# Sumanas Stripe Task

This is a Laravel application with Stripe integration for handling payments using Laravel Cashier, along with user authentication.
## Requirements

- PHP 8.x
- Composer
- Node.js and npm
- Laravel 8.x
- Stripe account

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/dipak09/Sumanas-Stripe-Task.git
    cd sumanas-stripe-task
    ```

2. Install dependencies:
    ```bash
    composer install
    npm install
    npm run dev
    ```

3. Configure environment variables:
    Copy `.env.example` to `.env` and set your database and Stripe credentials.

4. Run migrations and seeders:
    ```bash
    php artisan migrate
    php artisan db:seed --class=ProductsTableSeeder
    ```

## Usage

1. Start the development server:
    ```bash
    php artisan serve
    ```

2. Register and log in to view the dashboard.

3. To view products, visit `http://localhost:8000`, register, log in, and see the product list on the home page.

4. Click "Buy Now" on any product to proceed to the payment page.

5. Fill in your credit card details and submit the form to make a purchase.

6. View your purchase history on the dashboard.

## Updating Dependencies

To update PHP and JavaScript dependencies, run:
    ```bash
    composer update
    npm update
    ```

## Running Migrations

To run the migrations, use:
    ```bash
    php artisan migrate
    ```

## Running Seeders

To run the seeders, use:
    ```bash
    php artisan db:seed --class=ProductsTableSeeder
    ```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
