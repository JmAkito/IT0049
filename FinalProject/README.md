# FinalProject POS

A Laravel 12 point-of-sale application for managing products, customers, staff accounts, inventory, and sales.

## Features

- Authenticated staff sign-in, session regeneration, logout, and throttled login attempts.
- Product CRUD, image uploads, inventory quantities, and safe archival when sales reference a product.
- Customer CRUD with optional phone numbers and preserved historical sales.
- Staff CRUD with avatar uploads and Laravel's hashed password cast.
- Sale entry with optional customer, live total estimate, server-side price calculation, and transactional stock deduction.
- Insufficient stock rejects the whole sale; sales history keeps product/customer/staff/quantity/total/date details.
- SQLite by default for local use; Laravel's configured MySQL and PostgreSQL connections are available for deployment.
- Responsive interface, validation feedback, CSRF protection, and public-disk image storage.

## Requirements

- PHP 8.2 or later with PDO SQLite enabled (and Fileinfo for image uploads).
- Composer 2.
- Git is optional for local setup.

## Windows setup (PowerShell)

Open PowerShell in the folder containing this README, then run:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item -ItemType File -Force database/database.sqlite
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve --host 127.0.0.1 --port 8081
```

Open <http://127.0.0.1:8081>.

Demo account after the local seed:

- Username: `admin`
- Password: `Admin123!`

This is a classroom demo credential. Change it immediately before making an app publicly accessible. `migrate:fresh` deletes existing database tables and data; use it only for a fresh classroom setup.

Composer dependencies are included in `composer.lock`; `vendor/` is created by `composer install`. The interface uses inline CSS, so Node.js/npm is not required to run the app.

## Database setup

Local development uses SQLite at `database/database.sqlite`. The migration creates the required `products`, `customers`, `users`, and `sales` tables plus Laravel's sessions/cache/jobs tables. To use MySQL, set `DB_CONNECTION=mysql` and the usual `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` values in `.env`. PostgreSQL can be configured with `DB_CONNECTION=pgsql` and its corresponding connection values. Run `php artisan migrate --force` after setting production database credentials.

## Image storage

Uploads accept JPG, PNG, and WebP images up to 2 MB. Files are stored with generated names on Laravel's `public` disk. Run `php artisan storage:link` after installation so images can be displayed from `public/storage`.

## Sale integrity

The sale endpoint validates the request, begins a database transaction, and conditionally decrements inventory only when sufficient stock exists. If stock cannot be decremented, a validation error aborts the transaction and no sale row is created. The server calculates the total from the stored product price; the browser estimate is only a convenience.

## Deploying

1. Push the project to your GitHub repository. Do not commit `.env`, credentials, or a production database file.
2. Choose a PHP host that supports Laravel 12 and PHP 8.2+. Point the web root to Laravel's `public/` directory.
3. Configure a persistent MySQL or PostgreSQL database and set production environment variables (`APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, `APP_KEY`, `DB_CONNECTION`, and DB credentials). Generate a fresh application key with `php artisan key:generate --show` locally and add it as the host's `APP_KEY` secret.
4. Build dependencies with `composer install --no-dev --optimize-autoloader`; run `php artisan migrate --force` and `php artisan storage:link` during deployment.
5. Create the first production staff account using Laravel Tinker on the host. Replace the example values with a unique username and a private password:

   ```php
   App\Models\User::create([
       'full_name' => 'POS Administrator',
       'username' => 'choose-a-private-username',
       'password' => 'replace-with-a-long-private-password',
   ]);
   ```

   The model hashes the password automatically. Do not seed the classroom demo password into a public deployment.
6. Set writable permissions for `storage/` and `bootstrap/cache/`. Configure Laravel's public disk to persist uploads across deploys (or use the host's persistent storage).
7. Open the public URL and verify sign-in, each CRUD page, image display, a successful sale, an insufficient-stock rejection, and sales history.

The application source is deployment-ready, but the live deployment URL must be created in the hosting account and verified there before submitting it as a working deployment link.

## Canvas submission checklist (exactly four items)

1. **GitHub Repository Link** — repository containing this Laravel source, migrations, seed data, and README.
2. **ZIP Project Folder** — ZIP this folder without `vendor/`, `node_modules/`, `.env`, or local database data.
3. **Working Deployment Link** — your verified public application URL.
4. **Documentation PDF** — use `DOCUMENTATION_CHECKLIST.md` to capture required screenshots from your own system and write the short explanations/reflection. Fill in member names, section, professor, date, repository URL, and live URL; do not use mock screenshots.

## Project structure

- `app/Http/Controllers` — authentication, dashboard, CRUD, and sale workflows.
- `app/Models` — Eloquent models and relational links.
- `database/migrations` — schema and foreign key definitions.
- `database/seeders/DatabaseSeeder.php` — local demo account and sample products/customers.
- `resources/views` — responsive Blade pages.
- `routes/web.php` — guest and authenticated route groups.
