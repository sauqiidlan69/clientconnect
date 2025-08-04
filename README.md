# 📊 ClientConnect CRM

**ClientConnect CRM** is a role-based customer relationship management system built with **Laravel 11**. It helps organizations manage customer data, track interactions, handle support tickets, and generate reports with ease.

---

## 🚀 Features

- **User Authentication**
  - Registration, login, and password reset
  - Role-based access: `admin`, `support`, `customer`

- **Customer Management**
  - CRUD operations for customers
  - Search and filter by name, email, etc.

- **Interaction Tracking**
  - Log phone calls, meetings, and emails
  - View all interactions related to each customer

- **Ticketing System**
  - Customers can submit tickets
  - Admins can assign tickets to support staff
  - Support team can update and resolve tickets

- **Reports**
  - Export ticket and interaction data to **CSV** or **PDF**
  - Built using Laravel Excel and dompdf

- **Dashboards**
  - Role-based dashboards
  - Interactive charts powered by Chart.js

- **Notifications**
  - In-app alerts for ticket assignments, updates, and system events

---

## 🛠️ Tech Stack

| Layer       | Technology       |
|-------------|------------------|
| Backend     | Laravel 11 (PHP 8.3) |
| Frontend    | Blade, Bootstrap 5 |
| Database    | MySQL             |
| Export Tools| Laravel Excel, dompdf |
| Charts      | Chart.js          |
| Auth System | Laravel Breeze / Custom Middleware |

---

## ⚙️ Installation

Follow the steps below to set up the project on your local machine:

### Clone the repository
git clone https://github.com/sauqiidlan69/clientconnect.git

### Navigate into the project directory
cd clientconnect-crm

### Install dependencies
composer install

### Copy and edit .env
cp .env.example .env
#### Configure your DB credentials inside .env

### Generate app key
php artisan key:generate

### Run migrations and seeders
php artisan migrate --seed

### Serve the app
php artisan serve

---

## 👤 User Roles
| Role     | Capabilities                                               |
| -------- | ---------------------------------------------------------- |
| Admin    | Full access: manage users, customers, tickets, and reports |
| Support  | Manage assigned tickets, view customer interactions        |
| Customer | Submit support tickets, view own ticket history            |

---

## 📃 License

This project is open-sourced under the MIT License.
