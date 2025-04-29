# Mobility Health

**Solution d’Assistance Voyage avec mobilité**  
A modern travel assistance platform for managing customers, insurance policies, health records, and more.

---

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
- [Environment Variables](#environment-variables)
- [Project Structure](#project-structure)
- [API Overview](#api-overview)
- [Testing](#testing)
- [License](#license)

---

## Features

- User authentication (OTP, Sanctum)
- Customer registration and management
- Insurance policy and package management
- Health record tracking (polymorphic)
- File and document uploads (profile, ID, etc)
- Country and geographic area management
- Admin dashboard (web)
- RESTful API for mobile/web clients

---

## Tech Stack

- **Backend:** PHP 8.2+, [Laravel 12.x](https://laravel.com/)
- **API Auth:** [Laravel Sanctum](https://laravel.com/docs/12.x/sanctum)
- **File Handling:** [league/glide-symfony](https://glide.thephpleague.com/)
- **Testing:** PHPUnit
- **Frontend:** Blade templates, Vite (JS/CSS assets)
- **Database:** SQLite (default), MySQL/PostgreSQL supported

---

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & npm (for frontend assets)
- SQLite (default) or other supported DB

### Installation

```bash
git clone https://github.com/your-org/mobility-health.git
cd mobility-health

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Copy environment file and set your variables
cp .env.example .env

# Generate app key
php artisan key:generate

# (Optional) Create SQLite DB file
touch database/database.sqlite

# Run migrations
php artisan migrate

# Build frontend assets
npm run build

# Start the development server
php artisan serve
