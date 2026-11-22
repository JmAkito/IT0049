# FinalProject POS — Documentation PDF checklist

> This file is a guide for the required PDF, not a completed evidence report. Capture screenshots from your own running application. Add a brief explanation below every screenshot and replace every bracketed field.

## Cover page

- Project title: FinalProject POS
- Member name(s): Jolo Miguel Ambrad
- Section: IT0049 - TX33
- Professor: Mr. Mar Eli Sagsagat
- Date: November 23, 2026
- GitHub repository: https://github.com/JmAkito/IT0049
- Live deployment: Not deployed yet

## Project overview and technologies

Describe the application as a Laravel MVC point-of-sale system. Identify the PHP/Laravel version, database used, image storage disk, and the main features. Add a screenshot of the dashboard and explain what it shows.

## Database relationship diagram

```mermaid
erDiagram
    USERS ||--o{ SALES : records
    PRODUCTS ||--o{ SALES : includes
    CUSTOMERS o|--o{ SALES : selected_for
    USERS {
        bigint id PK
        string full_name
        string username UK
        string password
        string avatar
    }
    PRODUCTS {
        bigint id PK
        string name
        decimal price
        int stock_quantity
        string image
    }
    CUSTOMERS {
        bigint id PK
        string full_name
        string email UK
        string phone nullable
    }
    SALES {
        bigint id PK
        bigint product_id FK
        bigint customer_id FK nullable
        bigint sold_by FK
        int quantity
        decimal total_price
        timestamp created_at
    }
```

Explain that a sale always references one product and one staff user; customer selection is optional. Products and staff with sales are retained to protect history, while deleting a customer sets the old sale's customer reference to null.

## Required feature screenshots and captions

Use screenshots captured from your own application. A caption should say what the screenshot proves.

1. **Authentication and protected access** — login screen, then show an authenticated dashboard. Also show that a signed-out visit to a protected page returns to login.
2. **Product management** — product list plus add/edit form. Show a real uploaded product image displayed in the list.
3. **Customer management** — customer list and a create/edit form including an optional phone field.
4. **Staff management and password security** — staff list with an avatar displayed and the create/edit form. Explain that the submitted password is hashed by Laravel and is not shown again.
5. **Successful sale and inventory update** — record a sale, then show the success message, sales-history row, and reduced product stock.
6. **Insufficient-stock protection** — request more units than are available and show the validation message. Show that neither stock nor sales history changed.
7. **Sales history** — show product, customer (or walk-in), staff member, quantity, total price, and date/time.
8. **Repository and deployment** — show the GitHub repository and the live deployed application, and list both URLs in the document.

## Reflection

Write a short first-person reflection covering:

- Challenges encountered and how you resolved them.
- What you learned about Laravel MVC, database relationships, validation, authentication, file uploads, and transactions.
- What you would improve next (for example roles/permissions, reports, automated backups, or improved receipt printing).

## Export and final review

- Replace all bracketed placeholders and remove this instruction note.
- Ensure every screenshot is readable and has a short feature explanation.
- Confirm all member/course details and both links are correct.
- Export as PDF and verify the exported pages before Canvas submission.
