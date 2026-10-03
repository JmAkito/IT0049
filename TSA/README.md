# SwiftPOS CodeIgniter 4 Application

SwiftPOS is a simple Point-of-Sale account management application developed using CodeIgniter 4 and MySQL.

This project demonstrates database models, forms, validation, record creation, record editing, file upload, image preparation, and avatar display.

## Features

- Display customer accounts from MySQL
- Add new customer accounts
- Validate customer full name and email
- Edit existing customer accounts
- Display user and staff accounts from MySQL
- Add new user accounts
- Validate required and unique usernames
- Edit existing user accounts
- Upload JPG and PNG profile pictures
- Reject profile pictures larger than 2 MB
- Prepare uploaded avatars as 300 by 300 pixel images
- Display a placeholder image when no avatar is available

## Requirements

- PHP 8.1 or newer
- Composer
- MySQL or MariaDB
- CodeIgniter 4
- PHP extensions: intl, mysqli, mbstring, and gd
- XAMPP can be used for Apache, PHP, and MySQL

## Installation

Clone or download the project and open Command Prompt inside the project folder.

Install the required packages:

```cmd
composer install