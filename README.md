# Point of Sale (POS) System

A web-based Point of Sale (POS) System developed using Laravel, PHP, and MySQL. The application helps manage product inventory, customer information, staff accounts, and sales transactions through a centralized system.

## Live Application URL
* Hosted Version: [https://rk-final-project.page.gd/]
## Project Overview

The Point of Sale System is designed to simplify daily business operations by providing an organized platform for managing products, customers, staff, and sales records.

The system allows authorized users to monitor inventory, register new customers and staff members, process sales transactions, and review transaction history.

## Features

### 1. Dashboard
- Provides access to the main system modules.
- Serves as the central navigation area.

### 2. Product Inventory
- View available products.
- Add new products.
- Edit existing product information.
- Delete product records.
- Manage product prices and stock quantities.
- Upload product images.

### 3. Customer Management
- View registered customers.
- Add new customer profiles.
- Edit customer information.
- Delete customer records.

### 4. Staff Management
- View registered staff accounts.
- Register new staff members.
- Edit staff profiles.
- Upload staff profile pictures.
- Manage staff login credentials.

### 5. Sales Management
- Record new sales transactions.
- Select products and customers.
- Support walk-in customers.
- Specify purchase quantities.
- Automatically calculate transaction totals.
- Automatically update product stock after successful transactions.

### 6. Sales History
- View recorded sales transactions.
- Display product and customer information.
- Track the staff member responsible for each transaction.
- View quantities, total prices, and transaction dates.

### 7. Authentication
- Login functionality.
- Session-based access control.
- Logout functionality.
- Protected system pages.

## Technologies Used

- **Backend:** PHP, Laravel
- **Database:** MySQL
- **Frontend:** HTML, CSS
- **Development Environment:** Visual Studio Code
- **Local Server:** Laravel Artisan Development Server

## System Requirements

- PHP (version compatible with the installed Laravel version)
- Composer
- MySQL or XAMPP
- Laravel
- Web browser

## Installation and Setup

Follow these steps to run the project locally.

### 1. Configure the Database

Open the `.env` file and update the database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pos_system
DB_USERNAME=root
DB_PASSWORD=
```
Update the username and password according to your local MySQL configuration.

### 2. Set Up the Database

Create a MySQL database named:

```text
pos_system
```

**Important:** This project does not currently include an exported SQL database backup. The required database tables and existing records must be provided or recreated separately before the application can operate correctly.

### 3. Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

## Default Administrator Account

Use the following credentials to access the system:

| Field | Credentials |
|---|---|
| Username | `admin` |
| Password | `password123` |

**Security reminder:** These are default development credentials. Change the password before using the application in a production environment. Do not publish real administrator credentials in a public repository.

## Project Structure

```text
pos-laravel/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   │
│   └── Models/
│
├── public/
│   └── uploads/
│
├── resources/
│   └── views/
│       ├── auth/
│       ├── includes/
│       ├── products/
│       ├── customers/
│       ├── users/
│       ├── sales/
│       └── dashboard.blade.php
│
├── routes/
│   └── web.php
│
├── .env.example
├── artisan
├── composer.json
└── README.md
```

## Database Information

**Database Name:** `pos_system`

The database stores the application's information, including:

- User and staff accounts
- Product inventory
- Customer records
- Sales transactions

## Security Notes

- Do not upload your actual `.env` file to a public repository.
- Do not publish private database credentials.
- Change default administrator credentials before deployment.
- Keep database backups in a safe location.

## Author

**QUEJADA, RAINA KISHAN S.**

**Project:** Point of Sale (POS) System  
**Framework:** Laravel  
**Database:** MySQL

---

