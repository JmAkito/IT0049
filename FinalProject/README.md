# FinalProject POS System

A point-of-sale system built with CodeIgniter 4. It manages products, customers, staff accounts, sales, and product stock.

## Features

- Staff login and logout
- Protected dashboard and management pages
- Product create, view, update, and delete
- Product image uploads
- Customer create, view, update, and delete
- Staff account create, view, update, and delete
- Staff avatar uploads
- Sales recording with stock validation
- Automatic stock deduction when a sale is saved
- Sales history

## Requirements

- PHP 8.1 or newer
- Composer
- SQLite PHP extensions enabled: `sqlite3` and `pdo_sqlite`

## Local setup

1. Clone the repository.
2. Open a terminal in the `FinalProject` directory.
3. Copy `env` to `.env` if `.env` does not exist.
4. Set the local values in `.env`:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8081/'
   app.indexPage = ''

   database.default.DBDriver = SQLite3
   database.default.database = database.db
   database.default.DBPrefix =
   database.default.username =
   database.default.password =
   database.default.hostname =
   database.default.port =