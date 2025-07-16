# 🚀 Laravel Project Setup

A guide for getting started with local development and running tests for this Laravel project.

---

## 📦 Requirements

Before installation, make sure you have:

- PHP 8.2+
- Composer
- Node.js v22+
- MySQL or SQLite
- Git
- Docker (optional, for Sail)

---

## 🛠️ Installation

```bash
# Clone the repository
git clone https://github.com/Eugene-Melbourne/pizza-challenge.git
cd your-project

# Install PHP dependencies
composer install

# Install Node dependencies and build assets
npm install && npm run build

# Copy environment file
cp .env.example .env

# Generate Laravel app key
php artisan key:generate

# Set up your database in .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=your_db_name
# DB_USERNAME=root
# DB_PASSWORD=your_password

# Run database migrations and seeders
php artisan migrate --seed

# Start local server
php artisan serve
```
---

## 🧪 Running Tests

Run feature and unit tests using Pest:

```bash
php artisan test

# Or directly via Pest
./vendor/bin/pest
```

---

## 🐳 Docker with Laravel Sail (Optional)

If you're using Docker Desktop, you can run the project inside a container:

```bash
# Start services
./vendor/bin/sail up

# SSH into the container
./vendor/bin/sail shell

# If you need root access (e.g., to install system packages)
./vendor/bin/sail root-shell

# Run migrations and seeders
./vendor/bin/sail artisan migrate --seed

# Build front-end assets
./vendor/bin/sail npm run build

# Run tests
./vendor/bin/sail test
```

---

## 🧪 Running PHP Tests and PHP Code Quality Tools

Once inside the Sail container, you can run:

```bash
# Run feature and unit tests
php vendor/bin/pest

# Analyze PHP code
vendor/bin/phpstan analyse

# Run Laravel Pint (code style fixer)
vendor/bin/pint

```

These mirror the CI actions defined in `.github/workflows/lint.yml`, and can be run manually before committing.

---
---

## 🎨 Front-End Dev Workflow

This project uses **Vite**, **Vue 3**, **Tailwind CSS**, and **TypeScript** — with a full suite of formatting and linting tools. Here’s how to work with it effectively:

### 🧪 Development Mode

Start the Vite development server (with hot reload):

```bash
npm run dev
```

> 💡 If you're inside a Sail container, use:  
> `./vendor/bin/sail npm run dev`

---

### 🛠️ Building for Production

Compile and optimize front-end assets:

```bash
npm run build
```

For server-side rendering (SSR):

```bash
npm run build:ssr
```

---

### 🔄 Watch for File Changes

If needed, use Vite’s dev server (`dev`).

```bash
npm run dev
```
---

### 💅 JS Code Quality & Formatting

Run these tools to keep the front-end codebase clean and consistent:

```bash
# Format code with Prettier
npm run format

# Check formatting without making changes
npm run format:check

# Automatically fix lint errors with ESLint
npm run lint
```

These match the checks run automatically in CI (`lint.yml`). You can run them manually before pushing code to keep everything sharp.

---

## 📘 API Documentation

This project provides **OpenAPI-based documentation** for the Public Website Pizza Status Update API.

### 📝 Specification File

- The raw OpenAPI YAML file is available at:  
  [`/docs/public-website-api.yaml`](http://localhost/docs/public-website-api.yaml)  
  *(served via Laravel route from `public/docs/public-website-api.yaml`)*

### 🖥️ Interactive Documentation (HTML)

- View the live documentation at:  
  [`/docs/pizza-status`](http://localhost/docs/pizza-status)

This page uses **Stoplight Elements** to render the OpenAPI spec as an interactive UI, complete with collapsible sections, parameter info, and response codes.

> 💡 The spec is parsed directly from the YAML file, and styles are provided via CDN to keep it lightweight and readable.

---

## ✅ Quick help for Developers

```bash
./vendor/bin/sail shell

composer install
npm install

php vendor/bin/pest
vendor/bin/phpstan analyse
vendor/bin/pint


npm run format
npm run lint
npm run build

php artisan migrate:fresh --seed
php artisan queue:work
php artisan queue:listen

```


