# Laravel Custom Role and Permission System

This project implements a **custom Role & Permission** system using Laravel's built-in features — **policies**, **middleware**, and **gates** — without any third-party packages.

## 🚀 Features

- Requirment:
  - `PHP Version PHP Version 8.1 for Laravel 10`
  - `Composer`
  - `MYSQL Database`

- Installation guide:
  - `Clone the Repository from github`
  - `rename .env.example to .env and connect database to mysql`
  - `run command composer install , php artisan key:generate ,php artisan jwt:secret ,php artisan migrate and php artisan db:seed`


- Default User for:
  - `admin` : **email: admin@example.com**,**password:password**
  - `editor` : **email: editor@example.com**,**password:password**
  - `author` : **email: author@example.com**,**password:password**

- Role-based and permission-based access control.
- Three default roles:
  - `admin`
  - `editor`
  - `author`
- Custom permissions defined per role:
  - `view all users`: **admin**
  - `assign roles`: **admin**
  - `create article`: **author**
  - `edit own article`: **author**
  - `publish article`: **editor, admin**
  - `delete article`: **admin**
  - `view published`: **all authenticated**
  - `view own articles`: **author**

## 🔐 Authentication

Authentication is handled using **Laravel Sanctum**.

---

## 📌 API Endpoints

### 🔓 Public Routes

| Method | Endpoint     | Description          |
|--------|--------------|----------------------|
| POST   | `/register`  | Register a new user  |
| POST   | `/login`     | Login and receive token |

---

### 🔐 Protected Routes (Require Sanctum Authentication)

| Method | Endpoint         | Middleware                | Description                    |
|--------|------------------|---------------------------|--------------------------------|
| GET    | `/me`            | auth:sanctum              | Get current authenticated user |
| POST   | `/logout`        | auth:sanctum              | Logout the current user        |
| POST   | `/refresh`       | auth:sanctum              | Refresh token (if implemented) |

---

### 🔐 Role/Permission Restricted Routes

| Method | Endpoint         | Middleware                      | Description                 |
|--------|------------------|----------------------------------|-----------------------------|
| GET    | `/users`         | `permission:view all users`     | View all users (Admin only) |
| POST   | `/assign-role`   | `permission:assign roles`       | Assign roles (Admin only)   |

---

## 🧩 Role & Permission Setup

### Roles Table
Seeded or added via Admin panel:

```text
- admin
- editor
- author
