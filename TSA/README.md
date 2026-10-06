# SwiftPOS CodeIgniter POS Foundations

SwiftPOS is a student POS account-management project created using CodeIgniter 4 and MySQL.

## Current Features

- Customer account listing
- User or staff account listing
- Create and edit customer records
- Create and edit staff records
- Form validation
- Profile picture uploads
- MySQL database integration
- Password hashing
- Staff login and logout
- Session-based authentication
- Protected customer and user pages

## Authentication

Only logged-in staff members can access the Customer Accounts and User Accounts pages.

Demo login:

- Username: admin.jolo
- Password: SwiftPOS123

Passwords are stored in the database as secure password hashes and are checked using `password_verify()`.

## Protected Pages

The following pages require authentication:

- `/customers`
- `/customers/new`
- `/customers/{id}/edit`
- `/users`
- `/users/new`
- `/users/{id}/edit`

Visitors who are not logged in are redirected to the login page.

## Database

Database name:

```text
swiftpos_db