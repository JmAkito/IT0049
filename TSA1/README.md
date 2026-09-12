# SwiftPOS CodeIgniter POS Foundations

SwiftPOS is a four-page CodeIgniter 4 application created for IT0049 TFA1. It demonstrates routing, controllers, views, reusable layouts, navigation, and static PHP arrays before database integration.

## Required pages

| Page | Route | Controller method |
| --- | --- | --- |
| Landing page | `/` | `Pages::home` |
| About page | `/about` | `Pages::about` |
| Customer Accounts | `/customers` | `Customers::index` |
| User Accounts | `/users` | `Users::index` |

The Customer Accounts and User Accounts controllers each contain five sample records. Their views use `foreach` to render the records in tables.

## Requirements

- PHP 8.1 or newer
- Composer 2
- PHP extensions required by CodeIgniter 4, including `intl` and `mbstring`

## Setup and run

1. Clone or download this repository.
2. Open a terminal in the project directory.
3. Install dependencies:

   ```bash
   composer install
   ```

4. Copy the environment template:

   Windows PowerShell:

   ```powershell
   Copy-Item .env.example .env
   ```

   macOS or Linux:

   ```bash
   cp .env.example .env
   ```

5. Check that `app.baseURL` in `.env` is set to `http://localhost:8080/`.
6. Start the development server:

   ```bash
   php spark serve
   ```

7. Visit `http://localhost:8080` and test all four navigation links.

## Project structure

```text
app/
  Config/Routes.php
  Controllers/
    Pages.php
    Customers.php
    Users.php
  Views/
    layouts/main.php
    pages/home.php
    pages/about.php
    customers/index.php
    users/index.php
public/
  assets/css/style.css
database/
  database_export.sql
```

## Database note

This assessment explicitly uses static arrays, so the application does not need a database connection. `database/database_export.sql` is included as a placeholder for the submission checklist and records the intended database name.

## Verification checklist

- [ ] Composer dependencies install successfully
- [ ] The home page opens at `/`
- [ ] The about page opens at `/about`
- [ ] The customer page displays five records at `/customers`
- [ ] The user page displays five records at `/users`
- [ ] Every navigation link works on desktop and mobile widths
- [ ] Special characters are escaped with CodeIgniter's `esc()` helper
- [ ] The GitHub repository link is submitted
- [ ] The hosted application link is submitted

## Submission links

- GitHub repository: Add your repository URL here
- Hosted application: Add your deployed application URL here
