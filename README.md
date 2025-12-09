
# Vanity Ordering Make-Up System

A **Laravel 11** application with Breeze authentication for browsing, ordering, and tracking cosmetics from **Sephora, MAC, Maybelline, Olay, and L'Oreal**. Built with **PHP, Blade templates, Tailwind CSS, and MariaDB**, optimized for responsive layouts and reliable order management.

---

## Features

* **User Authentication**: Registration and login via Laravel Breeze.
* **Product Catalog**: Browse and order products from multiple brands.
* **Shopping Cart**: Add items to cart, manage quantities.
* **Checkout Process**: Secure checkout with order summary and transaction handling.
* **Order Tracking**: View order history and status updates (pending/paid/shipped/delivered/cancelled).
* **Inventory Management**: Real-time stock updates; admin controls to manage products and restock.
* **Responsive Design**: Mobile-friendly UI using Tailwind CSS and optional Alpine.js.

---

## Tech Stack

* **Framework**: Laravel 11
* **Authentication**: Laravel Breeze
* **Frontend**: Blade templates, Tailwind CSS, Alpine.js
* **Database**: MariaDB / MySQL
* **Build Tool**: Vite
* **Testing**: PHPUnit / Pest

---

## Installation

1. Clone the repository:

   ```bash
   git clone <repository-url>
   cd vanity
   ```
2. Install dependencies:

   ```bash
   composer install
   npm install
   ```
3. Set up environment:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Configure database in `.env` file.
5. Run migrations and seeders:

   ```bash
   php artisan migrate
   php artisan db:seed
   ```
6. Build assets:

   ```bash
   npm run build
   ```
7. Start the server:

   ```bash
   php artisan serve
   node --run dev
   ```
8. Access the app at `http://localhost:8000`.

---

## Usage

* Register or login as a customer.
* Browse products by brand and add items to the cart.
* Proceed to checkout with order summary and payment.
* Track order status and view purchase history.

---

## Project Structure

* `app/Http/Controllers/` – Application controllers
* `app/Models/` – Eloquent models
* `resources/views/` – Blade templates
* `routes/` – Route definitions
* `database/migrations/` – Database migrations
* `database/seeders/` – Seeders

---

## Documentation

| Area               | File                         |
| ------------------ | ---------------------------- |
| Architecture       | `docs/architecture.md`       |
| Use Cases & Flows  | `docs/use_cases.md`          |
| Checkout Sequence  | `docs/sequence_checkout.md`  |
| API Endpoints      | `docs/api_endpoints.md`      |
| SQL Schema         | `sql/schema.sql`             |
| UML Classes        | `uml/vanity_classes.puml`    |
| UI Mockup          | `ui/mockup.html`             |
| WinForms Reference | `csharp/WinFormsScaffold.cs` |
| Laravel Structure  | `laravel/structure.md`       |
| Acceptance Tests   | `tests/acceptance.md`        |
| Deployment Plan    | `deployment/plan.md`         |

---

## Contributing

1. Fork the repository.
2. Create a feature branch.
3. Make changes and commit.
4. Push the branch and open a pull request.

---

## License

This project is licensed under the **MIT License**.

---

