# Senior Citizen System

A Laravel web application for managing senior citizen records, assistance requests, and benefit releases. Role-based access control separates administrative tools from the resident self-service portal.

## Project Overview

| | |
|---|---|
| Framework | Laravel 12 |
| Language | PHP 8.2+ |
| Database | SQLite by default |
| Front end | Blade, Vite, and Tailwind CSS |

### Main Features

- Admin dashboard with senior, pending assistance request, and benefit release summaries
- Senior citizen records, assistance requests, and benefit release management
- Resident dashboard and account profile
- Registration, login, password reset, and account settings
- Server-side role checks on protected routes

## Roles and Access

| Feature / Route | Guest | `resident` | `admin` / `super_admin` |
|---|:---:|:---:|:---:|
| Login and registration (`/login`, `/register`) | Allowed | Redirected when signed in | Redirected when signed in |
| Resident dashboard (`/resident/dashboard`) | Redirected to login | Allowed | Denied (`403`) |
| Resident profile (`/resident/profile`) | Redirected to login | Own account only | Denied (`403`) |
| Admin dashboard (`/dashboard`) | Redirected to login | Denied (`403`) | Allowed |
| Senior records (`/seniors`) | Redirected to login | Denied (`403`) | Allowed |
| Assistance requests (`/assistance-requests`) | Redirected to login | Denied (`403`) | Allowed |
| Benefit releases (`/benefit-releases`) | Redirected to login | Denied (`403`) | Allowed |
| Logout and account settings | Login required | Allowed | Allowed |

Newly registered accounts are always assigned the `resident` role by the server; registration form input cannot grant administrator access. `super_admin` is retained for compatibility with existing administrator accounts.

## Role-Based Access Control

The `role` middleware is registered in `bootstrap/app.php`. Protected management routes use `auth` followed by `role:admin,super_admin`; resident routes use `auth` followed by `role:resident`. The middleware checks the authenticated user's role on the server and returns HTTP `403` for authenticated users without permission. Guests are redirected to login by the authentication middleware first.

## Local Setup

Requirements: PHP 8.2+, Composer, and Node.js/npm.

From the project directory, run:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
if (-not (Test-Path database\database.sqlite)) { New-Item -ItemType File database\database.sqlite | Out-Null }
php artisan migrate
npm install
npm run build
php artisan serve
```

The application will be available at `http://127.0.0.1:8000`. Configure `.env` for a different database or environment as needed. Do not commit `.env` or local database files.

## Tests

Run the role authorization feature tests:

```powershell
php artisan test tests/Feature/RoleAuthorizationTest.php
```

The tests cover guest redirects, administrator access, resident access to their own portal, and cross-role denial for management and resident routes.
